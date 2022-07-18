@extends('layouts.front')
@section('content')
<link rel="stylesheet" href="{{asset('front/css/importL.css')}}">

<section id="login">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(img/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Log In
                    </span>
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible message">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! Session::get('message') !!}
                    </div>
                    @endif
                      @if (count($errors) > 0)
                              <div class="alert alert-danger message">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                </div>
                
                <form class="login100-form validate-form" action="{{route('postLogin')}}" method="post" >
                    {{csrf_field()}}
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email"
                            placeholder="Enter email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <ul class="log_in_me">
                            <li>
                                <button class="login100-form-btn">
                                    Login
                                </button> 
                            </li>
                            <li>
                                <a href="{{route('password-reset')}}" class="btn btn-block btn-flat">Forgot Password</a>
                            </li>
                        </ul>
                    </div>
                </form>
                <!--<div class="register-box"><p>Dont have Account<a href="https://wa.me/61424966039" class="register-btn">  Register Here </a></p></div>-->
            </div>
        </div>
    </div>
</section>
@endsection