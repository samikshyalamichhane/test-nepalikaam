<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Dashboard\DashboardRepository;
use App\Models\Transaction;
use Image;
use Carbon\Carbon;
use Mail;
use DB;
use App\Models\Rate;
use App\Models\Dashboard;
use App\Models\Transactiondocuments;
use App\Repositories\User\UserRepository;
use App\User;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct(TransactionRepository $transaction, CustomerRepository $customer, DashboardRepository $dashboard, UserRepository $user)
    {
        $this->transaction = $transaction;
        $this->customer = $customer;
        $this->dashboard = $dashboard;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = $this->transaction->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.transaction.list', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dashboard  = Dashboard::latest()->first();
        $rate = Rate::latest()->first();
        return view('admin.transaction.create',compact('dashboard','rate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == 'Remit') {
            $this->validate($request, [
                'type' => 'required',
                'full_name' => 'required',
                'receiver_contact_number' => 'required',
                'pick_up_district' => 'required',
                'remit_amount' => 'required',
                'npr' => 'required',
                'customerid' => 'required',
                'transfer_receipt' => 'nullable|max:3048',
            ]);
        } elseif ($request->type == 'E-sewa') {
            $this->validate($request, [
                'type' => 'required',
                'esewa_number' => 'required',
                'remit_amount' => 'required',
                'npr' => 'required',
                'transfer_receipt' => 'nullable|max:3048',
            ]);
        } else {
            $this->validate($request, [
                'type' => 'required',
                'account_holder_name' => 'required',

                'contact_number' => 'required',
                'bank_name' => 'required',
                'bank_branch' => 'required',
                'account_number' => 'required',
                'remit_amount' => 'required',
                'npr' => 'required',

                'customerid' => 'required',
                'transfer_receipt' => 'nullable|max:3048',
            ]);
        }
        $customer = $this->customer->where('customerid', $request->customerid)->where('publish', '!=', 'new')->first();
        $dashboard = Dashboard::latest()->first();
        if ($customer) {
            $value = $request->except('image', 'transfer_receipt');
            $value['user_id'] = $customer->id;
            // $value['rate'] = Rate::orderBy('created_at', 'DESC')->first()->rate;
            $lastRate = Rate::orderBy('created_at','DESC')->first();
            
           
            $offer_price = $lastRate->offer_price;
            $offer_rate = $lastRate->offer_rate;
            
            if($offer_price > 0 && $offer_rate > 0){
                $actualSendingMoney = $request->remit_amount-$dashboard->service_charge;
                if($actualSendingMoney>=$offer_price){
                    $value['rate'] = $lastRate->offer_rate;
                    $value['npr'] = $actualSendingMoney * $lastRate->offer_rate;
                }else{
                    $value['rate'] =  $lastRate->rate;
                    $value['npr'] = $actualSendingMoney * $lastRate->rate;
                }
                
            }else{
                $actualSendingMoney = $request->remit_amount-$dashboard->service_charge;
                $value['rate'] =  $lastRate->rate;
                $value['npr'] = $actualSendingMoney * $lastRate->rate;
                
            }
            
            
            
            

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $randomNumber = substr(str_shuffle($permitted_chars), 0, 7);
            // $result=$this->transaction->where('random_token',$randomNumer)->first();
            // if(!$result){
            //     $randomNumber=rand(1, 100000000);
            // }
            $value['random_token'] = $randomNumber;

            $value = $this->transaction->create($value);
            if ($request->transfer_receipt) {
                $this->saveDocumentsOfTransaction($value->id, $request->file('transfer_receipt'));
            }
            // if($value){
            //     $data['name']=$value->user->name;
            //     $data['email']=Auth::user()->email;
            //     if($value->type=='Bank-Deposit'){
            //         $data['receiver_name']=$value->receiver_contact_name;
            //     }else{
            //         $data['receiver_name']=$value->full_name;
            //     }

            //     $data['amount']=$value->remit_amount;
            //     $data['token']=$value->random_token;
            //     Mail::send('email.firstSentTemplate', $data, function ($message) use ($data,$request) {
            //             $message->to($data['email'])->from('ananta.den2049@gmail.com');
            //                 $message->subject('transaction forwarded');

            //         });

            // }
            return redirect()->back()->with('message', 'Transaction Sent Successfully');
        } else {
            return redirect()->back()->with('message', 'Customer Id did not match');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = $this->transaction->findOrFail($id);
        return view('admin.transaction.viewDetail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = $this->transaction->findOrFail($id);
        return view('admin.transaction.edit', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->type == 'Remit') {
            $this->validate($request, [
                'type' => 'required',
                'full_name' => 'required',
                'receiver_contact_number' => 'required',
                'pick_up_district' => 'required',
                'remit_amount' => 'required',
                'npr' => 'required',
                'transfer_receipt' => 'nullable|max:3048',
            ]);
        } elseif ($request->type == 'E-sewa') {
            $this->validate($request, [
                'type' => 'required',
                'esewa_number' => 'required',
                'remit_amount' => 'required',
                'npr' => 'required',
                'transfer_receipt' => 'nullable|max:3048',
            ]);
        } else {
            $this->validate($request, [
                'type' => 'required',
                'account_holder_name' => 'required',
                'contact_number' => 'required',
                'bank_name' => 'required',
                'bank_branch' => 'required',
                'account_number' => 'required',
                'remit_amount' => 'required',
                'npr' => 'required',
                'transfer_receipt' => 'nullable|max:3048',
            ]);
        }

        $data = $request->except('status');
        $data['status'] = $request->status;
        if ($request->status == null) {
            $data['status'] = 0;
        }
        $data['new'] = 1;
        $ans = $this->transaction->update($data, $id);
        if ($ans) {
            $transaction = $this->transaction->findOrFail($id);
            $data['email'] = $transaction->user->email;
            $data['name'] = $transaction->user->name;
            if ($transaction->type == 'Bank-Deposit') {
                $data['receiver_name'] = $transaction->account_holder_name;
            } else {
                $data['receiver_name'] = $transaction->full_name;
            }
            $data['amount'] = $transaction->remit_amount;

            // if ($request->status == 2) {
            //     Mail::send('email.sentTemplate', $data, function ($message) use ($data, $request) {
            //         $message->to($data['email'])->from('admin@nepalikaam.com');
            //         $message->subject('sent');
            //     });
            // }

        }
        return redirect()->route('transaction.index')->with('message', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = $this->transaction->findOrFail($id);
        if ($transaction->transfer_receipt) {
            $imagePath = public_path('/images');
            if ((file_exists($imagePath . '/' . $transaction->transfer_receipt))) {
                unlink($imagePath . '/' . $transaction->transfer_receipt);
            }
        }
        $this->transaction->destroy($id);
        return redirect()->back()->with('message', 'Transaction Deleted Successfully');
    }
    public function dailyTransaction()
    {
        $today = Carbon::now();
        $details = $this->transaction->orderBy('created_at', 'desc')->whereDate('created_at', $today)->paginate(100);
        return view('admin.transaction.dailyTransaction', compact('details'));
    }
    public function statusChange(Request $request)
    {
        $ids = $request->ids;

        $transactions = DB::table("transactions")->whereIn('id', explode(",", $ids))->get();
        foreach ($transactions as $transaction) {

            $transaction = $this->transaction->changeStatus($transaction->id, $request->status);

            if ($transaction) {

                $data['email'] = $transaction->user->email;
                $data['name'] = $transaction->user->name;
                if ($transaction->type == 'Bank-Deposit') {
                    $data['receiver_name'] = $transaction->receiver_contact_name;
                } else {
                    $data['receiver_name'] = $transaction->full_name;
                }
                $data['amount'] = $transaction->remit_amount;
                // if($request->status==1){
                //     Mail::send('email.approveTemplate', $data, function ($message) use ($data,$request) {
                //         $message->to($data['email'])->from('ananta.den2049@gmail.com');
                //             $message->subject('approved');

                //     });
                // }else{
                //     Mail::send('email.sentTemplate', $data, function ($message) use ($data,$request) {
                //         $message->to($data['email'])->from('ananta.den2049@gmail.com');
                //             $message->subject('sent');

                //     });
                // }
            }
        }
        return response()->json([
            'message' => 'success',
            'status' => $request->status,
            'ids' => $ids,
        ]);
        // for($ids as $id){
        //     $this->transaction->changeStatus($id,$request->status);
        // }

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

    public function checkPromoCode(Request $request)
    {
        $code = $request->promo_code;
        $promo_codes = $this->user->where('customerid', $request->customerid)->firstOrFail()->promocodes()->get();

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

        $this->user->where('customerid', $request->customerid)->firstOrFail()->promocodes()->updateExistingPivot($matchedCode->id, ['is_expired' => 1]);

        return response()->json([
            'status' => true,
            'promo_code' => $matchedCode,
            'message' => 'Promo code matched',
        ]);
    }

    public function getByDate($date)
    {

        // dd(date($date));
        $details = DB::table('transactions')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->whereDate('transactions.created_at', $date)
            ->select('users.*', 'transactions.*')
            ->get();
        return response()->json([
            'status' => true,
            'html' => view('admin/transaction/transactionByDate', compact('details'))->render(),
            'message' => 'this is message '
        ]);
    }

    public function searchTransaction(Request $request)
    {
        $this->validate($request, [
            'searchData' => 'required',
        ]);
        $searchText = $request->searchData;
        $details = $this->transaction
            ->where('account_holder_name', 'like', '%' . $searchText . '%')
            ->orWhere('full_name', 'like', '%' . $searchText . '%')
            ->orWhere('contact_number', 'like', '%' . $searchText . '%')
            ->orWhere('bank_name', 'like', '%' . $searchText . '%')
            ->orWhere('bank_branch', 'like', '%' . $searchText . '%')
            ->orWhere('account_number', 'like', '%' . $searchText . '%')
            ->orWhere('receiver_contact_number', 'like', '%' . $searchText . '%')
            ->orWhere('pick_up_district', 'like', '%' . $searchText . '%')
            ->orWhere('remit_amount', 'like', '%' . $searchText . '%')
            ->orWhere('npr', 'like', '%' . $searchText . '%')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->orWhere('users.name', 'like', '%' . $searchText . '%')
            ->orWhere('users.customerid', 'like', '%' . $searchText . '%')
            ->paginate(10);

        return view('admin.transaction.searchResult', compact('details'));
    }

    public function completedTransactionReport()
    {
        $datas['details'] = $this->transaction->where('status', 2)->orderBy('created_at', 'DESC')->paginate(50);
        return view('admin.transaction.completedTransactionReport', $datas);
    }

    public function searchTransactionWithDates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_date' => 'required|date',
            'to_date' => 'required|date|after:from_date',
        ]);
        $errors = $validator->messages();
        if ($validator->fails()) {
            return response()->json([
                'errors' => view('admin.include.show_error', compact('errors'))->render()
            ]);
        }

        $customer_id = $request->customer_id;
        $customer_name = $request->customer_name;

        $details = $this->transaction
            ->where('status', 2)
            ->when($request->from_date && $request->to_date, function ($q) use ($request) {
                $q->whereBetween('created_at', [$request->from_date, $request->to_date]);
            })
            ->when($customer_id, function ($q) use ($customer_id) {
                $q->whereHas('user', function ($query) use ($customer_id) {
                    $query->where('customerid', $customer_id);
                });
            })
            ->when($customer_name, function ($q) use ($customer_name) {
                $q->whereHas('user', function ($query) use ($customer_name) {
                    $query->where('name', $customer_name);
                });
            })
            ->get();
        return view('admin.transaction.include.date-search-result', compact('details'));
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
            $img->fit(589, 383)->save($main . $document_name);

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

    public function getReceiverInfo($id, $type)
    {

        // $details = Receiver::where('type', $type)->get();
        // $details = User::join('transactions', 'users.id', '=', 'transactions.user_id')->where('type', $type)->get();
        $details = User::where('customerid', $id)->firstOrFail()->transactions()->orderBy('updated_at', 'DESC')->where('type', $type)->get();
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
}
