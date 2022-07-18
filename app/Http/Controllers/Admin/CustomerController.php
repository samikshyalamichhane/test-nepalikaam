<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\User\UserRepository;
use DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(CustomerRepository $customer, UserRepository $user)
    {
        $this->customer = $customer;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = $this->customer->orderBy('created_at', 'desc')->where('role', 'client')->where('publish', 'new')->get();
        return view('admin.customer.pendinglist', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = $this->customer->findOrFail($id);
        return view('admin.customer.detailView', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = $this->customer->find($id);
        return view('admin.customer.edit', compact('detail'));
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
        $value = $request->except(['password', 'submit__transaction']);
        $value['submit__transaction'] = is_null($request->submit__transaction) ? 0 : 1;
        $old = $this->user->find($id);
        $sameEmailVal = $old->email == $request->email ? true : false;
        $this->validate($request, $this->rules($old->id, $sameEmailVal));
        if ($request->password) {
            $value['password'] = bcrypt($request->password);
        }
        if ($request->citizenship) {
            $documents = $request->file('citizenship');
            $filename = time() . '.' . $documents->getClientOriginalName();
            $documents->move(public_path('document'), $filename);
            $value['citizenship'] = $filename;

        }
        $this->user->update($value, $id);
        return redirect()->route('approvedCustomer')->with('message', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changeStatus(Request $request)
    {

        $this->customer->changestatus($request->id, $request->status);
        return "success";
    }
    public function approvedList()
    {
        $details = $this->customer->orderBy('created_at', 'desc')->where('role', 'client')->where('publish', 'approved')->get();
        return view('admin.customer.approvedList', compact('details'));
    }
    public function rejectedList()
    {
        $details = $this->customer->orderBy('created_at', 'desc')->where('role', 'client')->where('publish', 'rejected')->get();
        return view('admin.customer.rejectedList', compact('details'));
    }
    public function approveCustomer($id)
    {
        $this->customer->approveCustomer($id);
        return redirect()->back()->with('message', 'Customer Approved');
    }
    public function rejectCustomer($id)
    {
        $this->customer->rejectCustomer($id);
        return redirect()->back()->with('message', 'Customer Rejected');
    }
    public function customerAdd()
    {
        $countries = DB::table('countries')->get();
        return view('admin.customer.addCustomer', compact('countries'));
    }
    public function saveCustomer(Request $request)
    {
        $message = ['citizenship.required' => 'Id image is required', 'address.required' => 'Unit Number/Street Name and Number is required'];
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:6',
            'citizenship' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'suberb' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'customerid' => 'unique:users',
        ], $message);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['role'] = 'client';
        $data['main'] = 0;
        $data['flag'] = 0;
        $data['publish'] = 'approved';
        $data['new'] = '0';
        $data['submit__transaction'] = is_null($request->submit__transaction) ? 0 : 1;

        if ($request->customerid) {

            $data['manualy'] = 1;
            $data['customerid'] = $request->customerid;
        } else {
            $recentUser = $this->user->orderBy('customerid', 'desc')->where('role', 'client')->where('manualy', null)->first();
            if ($recentUser) {
                $data['customerId'] = $recentUser->customerid + 1;
            } else {
                $data['customerid'] = 6001;
            }
        }
        if ($request->image) {
            $documents = $request->file('image');
            $filename = time() . '.' . $documents->getClientOriginalName();
            $documents->move(public_path('document'), $filename);
            $data['image'] = $filename;

        }
        if ($request->citizenship) {
            $documents = $request->file('citizenship');
            $filename = time() . '.' . $documents->getClientOriginalName();
            $documents->move(public_path('document'), $filename);
            $data['citizenship'] = $filename;

        }

        $this->user->create($data);
        return redirect()->route('approvedCustomer')->with('message', 'Customer Added Successfully');
    }
    public function rules($oldId = null, $sameEmailVal = false)
    {

        $rules = [
            'email' => 'unique:users|email',
            'customerid' => 'unique:users,customerid,' . $oldId,

        ];
        if ($sameEmailVal) {

            $rules['email'] = 'unique:users,email,' . $oldId . '|max:255';

        }
        return $rules;
    }

}
