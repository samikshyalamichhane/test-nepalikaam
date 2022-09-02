<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);
        $result = User::where('email', $request->email)->first();
        $remember_me = $request->has('remember') ? 1 : 0;
        if ($result) {
            if (!\Hash::check($request->password, $result->password)) {
                return back()->with('message', 'Invalid Username\Password');
            } elseif ($result->role != 'admin' && ($result->publish == 'new' || $result->publish == 'rejected')) {
                return back()->with('message', "Your account is inactive!<br> Please contact  Team.");
            } else {
                if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)){
                    $user = auth()->user();
                    Auth::login($user, true);
                    if ($result->role == 'client') {
                        return redirect()->route('clientDashboard');
                    } else {
                        return redirect()->route('dashboard.index');
                    }
                } else {
                    return back()->withInput()->withErrors(['email' => 'something is wrong!']);
                }
            }
        }
        return back()->with('message', 'Invalid Username\Password');
    }
    public function Logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('adminlogin');
    }
}
