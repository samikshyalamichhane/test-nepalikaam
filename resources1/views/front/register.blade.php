@extends('layouts.front')
@section('content')
<link rel="stylesheet" href="{{asset('front/css/importR.css')}}">
<section id="register">
    <div class="container">
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 mx-auto   pt-3 pr-3 pl-3 pb-3">
                    <form class=" validate-form" action="{{route('registerCLient')}}" method="post"
                        enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row form-group">
                            <div class="col-lg-12 text-center">
                                <span class="login100-form-title pb-3">
                                    Register Now
                                </span>
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
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Full name</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="wrap-input100 validate-input" data-validate="Name is required">
                                    <input class="input100" type="text" name="name" placeholder="Full name"
                                        value="{{old('name')}}">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Email Address</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="wrap-input100 validate-input"
                                    data-validate="Valid email is required: ex@abc.xyz">

                                    <input class="input100" type="email" name="email" placeholder="Email addess..."
                                        value="{{old('email')}}">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Mobile No.</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <!--<div class="form-group">-->
                                <!--  <span class="label-input100">Image</span>-->
                                <!--  <input type="file" name="image" class="form-control">-->
                                <!--</div>-->

                                <div class="wrap-input100 validate-input">
                                    <input class="input100" type="text" name="phone" placeholder="mobile"
                                        data-inputmask="'mask': '9999999999'" id="phone" value="{{old('phone')}}">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Street Name and Number</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <!-- <div class="wrap-input100 validate-input" >
                                    <span class="label-input100">Address</span>
                                    <input class="input100" type="text" name="address" placeholder="address">
                                    <span class="focus-input100"></span>
                                </div> -->
                                <div class="wrap-input100 validate-input"
                                    data-validate="Unit Number/ Street Nmae and Number required.">
                                    <input class="input100" type="text" name="address"
                                        placeholder="Unit Number/ Street Name and Number" value="{{old('address')}}">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Suburb</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="wrap-input100 validate-input" data-validate="Suberb required.">
                                    <input class="input100" type="text" name="suberb" placeholder="Suburb"
                                        value="{{old('suberb')}}">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">State</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="wrap-input100 validate-input" data-validate="State required.">
                                    <input class="input100" type="text" name="state" placeholder="State"
                                        value="{{old('state')}}">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Post Code</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="wrap-input100 validate-input" data-validate="Post Code required.">
                                    <input class="input100" type="text" name="post_code" placeholder="Post Code"
                                        value="{{old('post_code')}}">
                                    <span class="focus-input100"></span>
                                </div>
                                <!-- <div class="wrap-input100  "  >
                                    <span class="label-input100">Country</span>
                                    <select name="country" id="country" class="input100">
                                        <option selected disabled>Select Anyone</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>

                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Identity Document</label>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="wrap-input100  validate-input">
                                    <select name="idtype" id="idtype" class="input100 form-control">
                                        <option value="Passport">Passport</option>
                                        <option value="PhotoID">PhotoID</option>
                                        <option value="Australian Driving Licence">Australian Driving Licence</option>
                                    </select>

                                </div>
                                <!--  <div class="wrap-input100 validate-input">
                                    <span class="label-input100">ID Type</span>
                                    <input type="radio" name="idtype" value="Passport" > Passport
                                    <input type="radio" name="idtype" value="PhotoID"> PhotoID
                                    <input type="radio" name="idtype" value="Australian Driving Licence "> Australian Driving Licence
                                    <span class="focus-input100"></span>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Upload Id</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="form-group">
                                    <!-- <span class="label-input100">Upload Id</span> -->
                                    <input type="file" name="citizenship">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Password</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="wrap-input100 validate-input" data-validate="Password is required">
                                    <input class="input100" type="password" name="password" placeholder="Password">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="" class="col-lg-3 col-md-4">Re Enter Password</label>
                            <div class="col-lg-9 col-md-8 col-12">
                                <div class="wrap-input100 validate-input" data-validate="Repeat Password is required">
                                    <input class="input100" type="password" placeholder="Re-Password"
                                        name="password_confirmation">
                                    <span class="focus-input100"></span>
                                </div>
                            </div>

                        </div>




                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn">
                                    Register Now
                                </button>
                            </div>

                            <a href="{{route('login')}}" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                                Log in
                                <i class="fa fa-long-arrow-right m-l-5"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="toastNotification" tabindex="-1" role="dialog" aria-labelledby="toastNotificationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{ session('message') }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        </div>
      </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        const success = "{{ session('message') }}";
        if (success) {
            $('#toastNotification').modal();
        }
      $("#phone").inputmask({"mask": "9999999999"});
    })
</script>
@endpush