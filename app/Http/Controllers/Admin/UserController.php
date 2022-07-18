<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    public $access_options = array(
        'slider' => 'Slider',
        'service' => 'Service ',
        'testimonial' => 'Testimonial',
        'transaction' => 'Transaction',
        'customer' => 'Customer',
        'user' => 'User',
        'popupad' => "Popupad",
        'promocode' => "promocode",


    );
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = $this->user->orderBy('created_at', 'desc')->where('id', '!=', 1)->where('role', '!=', 'client')->get();
        return view('admin.user.list', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access_options = $this->access_options;
        return view('admin.user.create', compact('access_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'unique:users|email',
            'password' => 'required|min:7',
            'access' => 'required',
        ];
        $message = ['access.required' => "please select atleast one role"];
        $this->validate($request, $rules, $message);
        $value = $request->except('publish', 'confirm_password', 'access_level');
        $value['password'] = bcrypt($request->password);
        $value['access_level'] = '';
        $accesses = $request->get('access');
        foreach ($accesses as $access) {
            $value['access_level'] .= ($value['access_level'] == "" ? "" : ",") . $access;
        }

        $value['publish'] = is_null($request->publish) ? 'new' : 'approved';
        $value['flag'] = 0;
        $value['role'] = 'editor';
        $this->user->create($value);
        return redirect()->route('user.index')->with('message', 'User added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $access_options = $this->access_options;
        $detail = $this->user->find($id);
        $accesses = ($detail->access_level) ? explode(",", $detail->access_level) : array();
        return view('admin.user.edit', compact('detail', 'access_options', 'accesses'));
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
        $value = $request->except('password');
        $old = $this->user->find($id);
        $sameEmailVal = $old->email == $request->email ? true : false;
        $message = ['access.required' => "please select atleast one role"];
        $this->validate($request, $this->rules($old->id, $sameEmailVal), $message);
        if ($request->password) {
            $value['password'] = bcrypt($request->password);
        }
        $value['access_level'] = '';
        $accesses = $request->get('access');
        foreach ($accesses as $access) {
            $value['access_level'] .= ($value['access_level'] == "" ? "" : ",") . $access;
        }

        $value['publish'] = is_null($request->publish) ? 'new' : 'approved';
        $value['flag'] = 0;
        $value['role'] = 'editor';
        $this->user->update($value, $id);
        return redirect()->route('user.index')->with('message', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->destroy($id);
        return redirect()->back()->with('message', 'User Deleted Successfully');
    }
    public function rules($oldId = null, $sameEmailVal = false)
    {

        $rules = [
            'email' => 'unique:users|email',

        ];
        if ($sameEmailVal) {
            $rules['email'] = 'unique:users,email,' . $oldId . '|max:255';
        }
        return $rules;
    }

}
