<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Popupad;
use App\Models\Rate;
use App\Models\Receiver;
use App\Models\Transaction;
use App\Models\Transactiondocuments;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Slider\SliderRepository;
use App\Repositories\Testimonial\TestimonialRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\User\UserRepository;
use App\Models\Dashboard;
use App\User;
use Auth;
use Carbon\Carbon;
use Mail;
use DB;
use Illuminate\Http\Request;
use Session;
use Image;
use Hash;


class DefaultController extends Controller
{
    public function __construct(SliderRepository $slider, TestimonialRepository $testimonial, UserRepository $user, ServiceRepository $service, TransactionRepository $transaction, DashboardRepository $dashboard)
    {
        $this->slider = $slider;
        $this->testimonial = $testimonial;
        $this->user = $user;
        $this->service = $service;
        $this->transaction = $transaction;
        $this->dashboard = $dashboard;
    }
    public function index()
    {
        $sliders = $this->slider->orderBy('created_at', 'desc')->where('publish', 1)->take(3)->get();
        $testimonials = $this->testimonial->orderBy('created_at', 'desc')->where('publish', 1)->get();
        $popupads = Popupad::where('published', 1)->orderBy('created_at', 'DESC')->get();
        return view('front.index', compact('sliders', 'testimonials', 'popupads'));
    }
    public function login()
    {
        return view('front.login');
    }
    public function register()
    {
        $countries = DB::table('countries')->get();
        return view('front.register', compact('countries'));
    }
    public function services()
    {
        $services = $this->service->get();
        return view('front.services', compact('services'));
    }
    public function serviceInner($slug)
    {
        $detail = $this->service->where('slug', $slug)->first();
        if ($detail) {
            $services = $this->service->where('id', '!=', $detail->id)->get();
            return view('front.serviceInner', compact('detail', 'services'));
        }
        abort(404);
    }
    public function contactUs()
    {

        return view('front.contactUs');
    }
    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $data = array('email' => $request->email, 'body_message' => $request->message, 'name' => $request->name, 'subject' => $request->subject);
        Mail::send('email.contactTemplate', $data, function ($message) use ($data, $request) {
            $message->to('admin@nepalikaam.com')->from($data['email'], $data['name'])->replyTo($data['email']);
            $message->subject($data['subject']);
        });
        return redirect()->back()->with('message', 'Message Sent');
    }
    public function registerClient(Request $request)
    {
        $message = ['citizenship.required' => 'Id image is required', 'address.required' => 'Unit Number/Street Name and Number is required'];
        $request->request->add(['customerid' => '']);
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6',
            'citizenship' => 'required|max:2048',
            'phone' => 'required',
            'address' => 'required',
            'suberb' => 'required',
            'state' => 'required',
            'post_code' => 'required',

            'idtype' => 'required',
            'customerid' => 'unique:users',

        ], $message);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['role'] = 'client';
        $data['main'] = 0;
        $data['flag'] = 0;

        $recentUser = $this->user->orderBy('customerid', 'desc')->where('role', 'client')->where('manualy', 0)->first();

        if ($recentUser) {
            $data['customerid'] = $recentUser->customerid + 1;
        } else {
            $data['customerid'] = 6001;
        }

        if ($request->citizenship) {
            $documents = $request->file('citizenship');
            $filename = time() . $documents->getClientOriginalName();
            $documents->move(public_path('document'), $filename);
            $data['citizenship'] = $filename;
        }

        $data = $this->user->create($data);
        if ($data) {
            $value = [
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                'idtype' => $data->idtype,
                'customerid' => $data->customerid,
                'citizenship' => $data->citizenship,
                'suberb' => $data->suberb,
                'state' => $data->state,
                'post_code' => $data->post_code,
                'customerid' => $data->customerid
            ];
            Mail::send('email.registerTemplate', $value, function ($message) use ($value, $request) {
                $message->to('kaam.nepali@gmail.com')->from($value['email']);
                $message->subject('New Registration' . '-' . $value['name'] . '-' . $value['customerid']);
                $message->cc('remit@nepalikaam.com');
            });
            Mail::send('email.clientRegisterTemplate', $value, function ($message) use ($value, $request) {
                $message->to($value['email'])->from('admin@nepalikaam.com');
                $message->subject('Thank you for joining us');
            });
        }
        return redirect()->back()->with('message', 'Thank U for registering. You can login by clicking login button');
    }
    public function clientDashboard()
    {
        $transactions = Auth::user()->transactions()->orderBy('updated_at', 'DESC')->paginate(6);
        $detail = $this->dashboard->first();
        $receivers = Auth::user()->receivers()->orderBy('updated_at', 'DESC')->paginate(6);
        $CurrentMonthTransaction = Auth::user()->transactions()->whereMonth('created_at', Carbon::now()->month)
            ->get();
        return view('front.clientDashboard', compact('transactions','detail','CurrentMonthTransaction','receivers'));
    }

    public function allTransaction()
    {
        $transactions = Auth::user()->transactions()->orderBy('updated_at', 'DESC')->get();
        $detail = $this->dashboard->first();
        return view('front.allTransaction', compact('transactions','detail'));
    }

    public function logOut()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
    public function makeTransaction()
    {
        $detail = $this->dashboard->first();
        return view('front.transactionForm')->with(compact('detail'));
    }
   
    public function saveTransaction(Request $request)
    {
        // dd($request->all());
        $dashboard_composer = $this->dashboard->first();

        if ($request->type == 'Remit') {
            $this->validate($request, [
                'type' => 'required',
                'full_name' => 'required',
                'receiver_contact_number' => 'required',
                'pick_up_district' => 'required|regex:/^[a-zA-Z-" "]+$/u',
                'remit_amount' => 'required|lte:' . $dashboard_composer->transaction_limit_remit . '|gt: 1',
                'npr' => 'required',
                'transfer_receipt' => 'required|max:3048',
                // 'receiver__id' => 'required',
            ],['pick_up_district.regex' => 'District must be in string']);
        } elseif ($request->type == 'E-sewa') {
            $this->validate($request, [
                'type' => 'required',
                'esewa_number' => 'required',
                'remit_amount' => 'required|lte:' . $dashboard_composer->transaction_limit_esewa . '|gt: 1',
                'npr' => 'required',
                'transfer_receipt' => 'required|max:3048',
            ]);
        } else {
            $this->validate($request, [
                'type' => 'required',
                'account_holder_name' => 'required',
                'contact_number' => 'required',
                'bank_name' => 'required',
                'bank_branch' => 'required',
                'account_number' => 'required',
                'remit_amount' => 'required|lte:' . $dashboard_composer->transaction_limit_bank_deposit . '|gt: 1',
                'npr' => 'required',
                'transfer_receipt' => 'required|max:3048',
                // 'receiver__id' => 'required',
            ]);
        }

        $value = $request->except('image', 'transfer_receipt');

        $templateSubject = $dashboard_composer->newTransactionSubject;

        $value['user_id'] = Auth::user()->id;
        // $value['rate'] = Rate::orderBy('created_at', 'DESC')->first()->rate;
        
        $lastRate = Rate::orderBy('created_at','DESC')->first();
        $offer_price = $lastRate->offer_price;
        $offer_rate = $lastRate->offer_rate;
        $dashboard= Dashboard::latest()->first();
        
        if($offer_price > 0 && $offer_rate > 0){
            
            $actualSendingMoney = $request->remit_amount-($dashboard->service_charge??0);
            if($actualSendingMoney>=$offer_price){
                $value['rate'] = $lastRate->offer_rate;
                $value['npr'] = $actualSendingMoney * $lastRate->offer_rate;
            }else{
                $value['rate'] =  $lastRate->rate;
                $value['npr'] = $actualSendingMoney * $lastRate->rate;
            }
            
        }else{
            $actualSendingMoney = $request->remit_amount-($dashboard->service_charge??0);
            $value['rate'] =  $lastRate->rate;
            $value['npr'] = $actualSendingMoney * $lastRate->rate;
            
        }
        

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomNumber = substr(str_shuffle($permitted_chars), 0, 7);
        // $result=$this->transaction->where('random_token',$randomNumer)->first();
        // if(!$result){
        //     $randomNumber=rand(1, 100000000);
        // }
        // dd($request->receiver__id);
        $value['random_token'] = $randomNumber;
        // for those receivers that has all info

        if (isset($request->receiver__id)) {

            $receiver__info = Transaction::where('receiver__id', $request->receiver__id)->get();
            // dd($receiver__info);
            foreach ($receiver__info as $data) {
                $receiver__id = [
                    'receiver__id' => $value['receiver__id'],
                ];
                // updates all receiver with newly generated receiver__id that matches
                $success = $data->update($receiver__id);
            }
            if ($success) {
                // creates transaction after receiver__id is set.
                $value = $this->transaction->create($value);
                if ($request->transfer_receipt) {
                    $this->saveDocumentsOfTransaction($value->id, $request->file('transfer_receipt'));
                }
                if ($value) {
                    $data = [
                        'name' => $value->user->name,
                        'type' => $value->type,
                        'customerid' => $value->user->customerid,
                        'phone' => $value->user->phone,
                        'email' => Auth::user()->email,
                        'amount' => $value->remit_amount,
                        'npr' => $value->npr,
                        'token' => $value->random_token,
                        'transfer_receipt' => $value->documents,
                        'promo_code' => $value->promo_code ?? '0'
                    ];
                    if ($value->type == 'Bank-Deposit') {
                        $deposit = [
                            'receiver_name' => $value->account_holder_name,
                            'receiver_contact_no' => $value->contact_number,
                            'bank_name' => $value->bank_name,
                            'bank_branch' => $value->bank_branch,
                            'account_number' => $value->account_number,
                        ];
                        $data = array_merge($data, $deposit);
                    } elseif ($value->type == 'E-sewa') {
                        $esewa = [
                            'esewa_number' => $value->esewa_number
                        ];
                        $data = array_merge($data, $esewa);
                    } else {
                        $remit = [
                            'receiver_name' => $value->full_name,
                            'receiver_contact_no' => $value->receiver_contact_number,
                            'pick_up_district' => $value->pick_up_district,
                        ];
                        $data = array_merge($data, $remit);
                    }
                    //   New Transaction email to admin
                    Mail::send('email.firstSentTemplate', $data, function ($message) use ($data, $request) {
                        $message->to('prabin.shr11@gmail.com')->from($data['email']);
                        $message->subject('New Transaction' . '-' . $data['name'] . '-' . $data['customerid']);
                        $message->cc('admin@nepalikaam.com');
                    });

                    //   New Transaction email to customer
                    Mail::send('email.newTransactionToCustomer', $data, function ($message) use ($data, $request, $templateSubject) {
                        $message->to($data['email'])->from('admin@nepalikaam.com');
                        $message->subject($templateSubject);
                    });
                }
                return redirect()->back()->with('message', 'Transaction Sent Successfully');
            } else {
                return redirect()->back()->with('message', 'Sorry, transaction has not sent.');
            }
        } else if (!isset($request->receiver__id) && isset($request->random_token)) {
            $infos = collect([]);
            if ($request->type == 'Bank-Deposit') {
                $datas = Transaction::where('type', '=', $request->type)->where('account_number', '=', $request->account_number)->get();
                foreach ($datas as $data) {
                    $infos->push($data);
                }
            } else {
                $datas = Transaction::where('type', '=', $request->type)->where('receiver_contact_number', '=', $request->receiver_contact_number)->get();
                foreach ($datas as $data) {
                    $infos->push($data);
                }
            }

            foreach ($infos as $data) {
                $receiver__id = [
                    'receiver__id' => $randomNumber,
                ];
                $success = $data->update($receiver__id);
                // dd($data);
            }

            if ($success) {
                $value['receiver__id'] = $randomNumber;
                $value = $this->transaction->create($value);
                if ($request->transfer_receipt) {
                    $this->saveDocumentsOfTransaction($value->id, $request->file('transfer_receipt'));
                }
                if ($value) {
                    $data = [
                        'name' => $value->user->name,
                        'type' => $value->type,
                        'customerid' => $value->user->customerid,
                        'phone' => $value->user->phone,
                        'email' => Auth::user()->email,
                        'amount' => $value->remit_amount,
                        'npr' => $value->npr,
                        'token' => $value->random_token,
                        'transfer_receipt' => $value->documents,
                        'promo_code' => $value->promo_code ?? '0'
                    ];
                    if ($value->type == 'Bank-Deposit') {
                        $deposit = [
                            'receiver_name' => $value->account_holder_name,
                            'receiver_contact_no' => $value->contact_number,
                            'bank_name' => $value->bank_name,
                            'bank_branch' => $value->bank_branch,
                            'account_number' => $value->account_number,
                        ];
                        $data = array_merge($data, $deposit);
                    } elseif ($value->type == 'E-sewa') {
                        $esewa = [
                            'esewa_number' => $value->esewa_number
                        ];
                        $data = array_merge($data, $esewa);
                    } else {
                        $remit = [
                            'receiver_name' => $value->full_name,
                            'receiver_contact_no' => $value->receiver_contact_number,
                            'pick_up_district' => $value->pick_up_district,
                        ];
                        $data = array_merge($data, $remit);
                    }
                    //   New Transaction email to admin
                    Mail::send('email.firstSentTemplate', $data, function ($message) use ($data, $request) {
                        $message->to('prabin.shr11@gmail.com')->from($data['email']);
                        $message->subject('New Transaction' . '-' . $data['name'] . '-' . $data['customerid']);
                        $message->cc('admin@nepalikaam.com');
                    });

                    //   New Transaction email to customer
                    Mail::send('email.newTransactionToCustomer', $data, function ($message) use ($data, $request, $templateSubject) {
                        $message->to($data['email'])->from('admin@nepalikaam.com');
                        $message->subject($templateSubject);
                    });
                }

                return redirect()->back()->with('message', 'Congratulations!!!Your Transaction Successful !!!');
            } else {
                return redirect()->back()->with('message', 'Sorry, transaction has not sent.');
            }
        } else {
            $value['receiver__id'] = $randomNumber;
            $value = $this->transaction->create($value);
            if ($request->transfer_receipt) {
                $this->saveDocumentsOfTransaction($value->id, $request->file('transfer_receipt'));
            }
            if ($value) {
                $data = [
                    'name' => $value->user->name,
                    'type' => $value->type,
                    'customerid' => $value->user->customerid,
                    'phone' => $value->user->phone,
                    'email' => Auth::user()->email,
                    'amount' => $value->remit_amount,
                    'npr' => $value->npr,
                    'token' => $value->random_token,
                    'transfer_receipt' => $value->documents,
                    'promo_code' => $value->promo_code ?? '0'
                ];
                if ($value->type == 'Bank-Deposit') {
                    $deposit = [
                        'receiver_name' => $value->account_holder_name,
                        'receiver_contact_no' => $value->contact_number,
                        'bank_name' => $value->bank_name,
                        'bank_branch' => $value->bank_branch,
                        'account_number' => $value->account_number,
                    ];
                    $data = array_merge($data, $deposit);
                } elseif ($value->type == 'E-sewa') {
                    $esewa = [
                        'esewa_number' => $value->esewa_number
                    ];
                    $data = array_merge($data, $esewa);
                } else {
                    $remit = [
                        'receiver_name' => $value->full_name,
                        'receiver_contact_no' => $value->receiver_contact_number,
                        'pick_up_district' => $value->pick_up_district,
                    ];
                    $data = array_merge($data, $remit);
                }
                //   New Transaction email to admin
                Mail::send('email.firstSentTemplate', $data, function ($message) use ($data, $request) {
                    $message->to('prabin.shr11@gmail.com')->from($data['email']);
                    $message->subject('New Transaction' . '-' . $data['name'] . '-' . $data['customerid']);
                    $message->cc('admin@nepalikaam.com');
                });

                //   New Transaction email to customer
                Mail::send('email.newTransactionToCustomer', $data, function ($message) use ($data, $request, $templateSubject) {
                    $message->to($data['email'])->from('admin@nepalikaam.com');
                    $message->subject($templateSubject);
                });
            }
            return redirect()->back()->with('message', 'Transaction sent successfully');
        }
    }
    
    public function checkPromoCode(Request $request)
    {
        $code = $request->promo_code;
        $promo_codes = auth()->user()->promocodes()->get();
        
        if ($promo_codes->isEmpty()) {
            return response()->json([
                'status' => false,
                'promo_code' => null,
                'message' => 'Promo code not found',
            ]);
        }
        
        if (!$code) {
            return response()->json([
                'status' => false,
                'promo_code' => null,
                'message' => 'Please enter promo code',
            ]);
        }

        $matchedCode = $promo_codes->firstWhere('promo_code', $code);
        if (!$matchedCode) {
            return response()->json([
                'status' => false,
                'promo_code' => null,
                'message' => 'Promo code did not matched',
            ]);
        }
        
        auth()->user()->promocodes()->updateExistingPivot($matchedCode->id, ['is_expired' => 1]);


        return response()->json([
            'status' => true,
            'promo_code' => $matchedCode,
            'message' => 'Promo code matched',
        ]);
    }
   
    public function saveReceiver(Request $request)
    {
        $formInput = $request->all();
        $data['type'] = $formInput['type'];
        if ($request->type == 'Bank-Deposit') {
            $data['receiver_name'] = $formInput['account_holder_name'];
            $data['receiver_contact_no'] = $formInput['contact_number'];
            $data['bank_name'] = $formInput['bank_name'];
            $data['bank_branch'] = $formInput['bank_branch'];
            $data['account_number'] = $formInput['account_number'];
            $this->sendToReceiverBank(auth()->user()->id, $data);
        } else {
            $data['receiver_name'] = $formInput['full_name'];
            $data['receiver_contact_no'] = $formInput['receiver_contact_number'];
            $data['pick_up_district'] = $formInput['pick_up_district'];
            $this->sendToReceiverRemit(auth()->user()->id, $data);
        }
        return response(['success' => true, 'data' => $data]);
    }

    public function sendToReceiverRemit($user_id, $formInput)
    {
        $datas = [
            'type' => $formInput['type'],
            'user_id' => $user_id,
            'account_holder_name' => null,
            'full_name' => $formInput['receiver_name'],
            'contact_number' => $formInput['receiver_contact_no'],
            'pick_up_district' => $formInput['pick_up_district'],
        ];

        $oldRecord = Receiver::where([
            'type' => $formInput['type'],
            'full_name' => $formInput['receiver_name'],
            'user_id' => $user_id,
        ])->first();
        if ($oldRecord) {
            $oldRecord->update($datas);
        } else {
            Receiver::create($datas);
        }
    }

    public function sendToReceiverBank($user_id, $formInput)
    {
        $datas = [
            'type' => $formInput['type'],
            'user_id' => $user_id,
            'account_holder_name' => $formInput['receiver_name'],
            'contact_number' => $formInput['receiver_contact_no'],
            'bank_name' => $formInput['bank_name'],
            'bank_branch' => $formInput['bank_branch'],
            'account_number' => $formInput['account_number'],
        ];
        $oldRecord = Receiver::where([
            'type' => $formInput['type'],
            'account_holder_name' => $formInput['receiver_name'],
            'user_id' => $user_id,
        ])->first();
        if ($oldRecord) {
            $oldRecord->update($datas);
        } else {
            Receiver::create($datas);
        }
    }

    public function imageProcessing($image)
    {
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        $listingPath = public_path('images/listing');
        $mainPath = public_path('images/main');

        $image->move($mainPath, $input['imagename']);
        $destinationPath = public_path('/images');
        return $input['imagename'];
    }
    public function trackRemit()
    {
        return view('front.trackRemit');
    }
    public function searchRemit($code)
    {
        $id = $this->user->where('customerid', $code)->first()->id;
        // dd($id);
        $value = $this->transaction->where('user_id', $id)->orderBy('updated_at', 'DESC')->take(2)->get();
        if ($value) {
            return response(['result' => 'success', 'data' => $value]);
        } else {
            return response(['result' => 'fail']);
        }
    }
    public function editProfile($id)
    {
        $data = User::find($id);
        $detail = $this->dashboard->first();
        return view('front.editProfile', compact('data','detail'));
    }

    public function viewProfile($id)
    {
        $data = User::find($id);
        $detail = $this->dashboard->first();
        return view('front.viewProfile', compact('data','detail'));
    }

    public function updateProfile(Request $request, $id)
    {
        $data = User::find($id);
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->suberb = $request->suberb;
        $data->state = $request->state;
        $data->post_code = $request->post_code;
        $data->save();
        return redirect()->back()->with('message', 'Profile Updated Successfully');
    }
    public function tax()
    {
        return view('front.tax');
    }

    public function getReceiverInfo($type)
    {
        // dd('hello');
        // $details = Receiver::where('type', $type)->get();
        // $details = User::join('transactions', 'users.id', '=', 'transactions.user_id')->where('type', $type)->get();
        $details = User::findOrFail(auth()->user()->id)->transactions()->orderBy('updated_at', 'DESC')->where('type', $type)->get();
        if ($type == 'Remit') {
            $datas = $details->unique('full_name');
        } else {
            $datas = $details->unique('account_holder_name');
        }
        // $datas = $details->unique('receiver__id');
        $details = $datas->values()->all();

        // dd($details);
        return response([
            'success' => true,
            'data' => $details,
        ]);
    }

    public function getSavedPerson($type)
    {
        $data = User::findOrFail(auth()->user()->id)->transactions()->where('type', $type)->get();
        if ($type == 'Remit') {
            $data = $data->pluck('full_name');
        } else {
            $data = $data->pluck('account_holder_name');
        }
        return response([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function getAllRates()
    {
        $rates = Rate::orderBy('updated_at', 'DESC')->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->distinct()->get();
        // dd($rates);
                return response([
            'success' => true,
            'data' => $rates,
        ]);
    }

    public function getAllReceivers()
    {

        $transactionDetails = Transaction::where('user_id', '=', auth()->user()->id)->orderBy('updated_at', 'DESC')->get()->groupBy('type');
        foreach ($transactionDetails as $key => $transactionDetail) {
            if ($key == 'Remit') {
                $data1 = $transactionDetail->unique('receiver_contact_number')->values()->all();
            } else {
                $data2 = $transactionDetail->unique('account_number')->values()->all();
            }
        }
        $details = array_merge($data1 ?? [], $data2 ?? []);
        $detail = $this->dashboard->first();
        return view('front.receiver.list', compact('details','detail'));
    }

    public function editReceiver($id)
    {
        $data = Transaction::where('user_id', auth()->user()->id)->where('receiver__id', '=', $id)->orWhere('account_number', '=', $id)->orWhere('receiver_contact_number', '=', $id)->first();
        return view('front.receiver.edit', compact('data'));
    }

    public function updateReceiver(Request $request, $id)
    {
        if ($request->type == 'Remit') {
            $this->validate($request, [
                'type' => 'required',
                'full_name' => 'required',
                'receiver_contact_number' => 'required',
                'pick_up_district' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'type' => 'required',
                'account_holder_name' => 'required',
                'contact_number' => 'required',
                'bank_name' => 'required',
                'bank_branch' => 'required',
                'account_number' => 'required',
            ]);
        }

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $randomNumber = substr(str_shuffle($permitted_chars), 0, 7);
        // dd($request->all());
        $value = $request->except('receiver__id');
        if (isset($request->receiver__id)) {
            $receiver__info = Transaction::where('receiver__id', $request->receiver__id)->get();
            foreach ($receiver__info as $key => $info) {
                $value['receiver__id'] = $receiver__info[$key]['receiver__id'];
                $success = $info->update($value);
            }

            if ($success) {
                return redirect()->route('getAllReceivers')->with('message', 'Receiver Updated Successfully');
            }
        } else if (!isset($request->receiver__id) && (isset($request->account_number) || isset($request->receiver_contact_number))) {
            $infos = collect([]);
            if ($request->type == 'Bank-Deposit') {
                $datas = Transaction::where('type', '=', $request->type)->where('account_number', '=', $request->account_number)->get();
                foreach ($datas as $data) {
                    $infos->push($data);
                }
            } else {
                $datas = Transaction::where('type', '=', $request->type)->where('receiver_contact_number', '=', $request->receiver_contact_number)->get();
                foreach ($datas as $data) {
                    $infos->push($data);
                }
            }
            foreach ($infos as $data) {
                $value['receiver__id'] = $randomNumber;
                $success = $data->update($value);
            }
            // dd($infos);
            if ($success) {
                return redirect()->back()->with('message', 'Receiver Updated Successfully');
            }
        }
    }

    //save different size of images inside image folder
    public function saveDocumentsOfTransaction($id, $filename)
    {
        ini_set('memory_limit', '500M');
        for ($i = 0; $i < count($filename); $i++) {
            $image = $filename[$i];
            $document_name = time() . rand() . '.' . $image->getClientOriginalExtension();

            $main = public_path('images/main/');

            $thumbnail = public_path('images/thumbnail/');

            $img = Image::make($image->getRealPath());
            $img->save($main . $document_name);

            $img = Image::make($image->getRealPath());
            $img->fit(349, 219)->save($thumbnail . $document_name);

            $input = array('transaction_id' => $id, 'document' => $document_name);
            Transactiondocuments::create($input);
        }
    }

    public function removeParticularImage(Request $request)
    {
        $id = $request->datas;
        $thatImage = Transactiondocuments::findorfail($id);
        $thumbnail = public_path('images/thumbnail/');
        $main = public_path('images/main/');
        $status = $thatImage->delete();
        if (file_exists($thumbnail . $thatImage->image)) {
            unlink($thumbnail . $thatImage->image);
            unlink($main . $thatImage->image);
        }

        if (isset($status)) {
            return response()->json(['success' => 'success']);
        } else {
            return response()->json(['error' => 'error in server']);
        }
    }
    
    public function getBankDetail()
    {
        $detail = $this->dashboard->first();
        return view('front.getBankDetail')->with(compact('detail'));
    }
}

// if (isset($request->receiver__id)) {
//     $receiver__info = Transaction::where('receiver__id', $request->receiver__id)->first();
//     if ($receiver__info) {
//         $value['receiver__id'] = $receiver__info->receiver__id;
//         $receiver__info->update($value);
//         $value = $this->transaction->create($value);
//         return redirect()->back()->with('message', 'Transaction Sent Successfully');
//     }
// } else {
//     $oldReceiver = Transaction::where('random_token', $value['random_token'])->first();
//     if(isset( $oldReceiver )) {
//         $value['receiver__id'] = $oldReceiver['random_token'];
//         dd($value);
//         $oldReceiver->update($value);
//     }
//     $value['receiver__id'] = $randomNumber;
//     return redirect()->back()->with('message', 'Transaction Sent Successfully');
// }
