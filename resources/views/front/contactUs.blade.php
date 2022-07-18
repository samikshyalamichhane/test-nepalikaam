@extends('layouts.front')
@section('content')
<link rel="stylesheet" href="{{asset('front/css/innerpage.css')}}">
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image: url('{{asset('front/img/call.jpg')}}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__list--item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumbs__list--item"><a href="#">Contact</a></li>
                </ul>
                <h2>Contact Us</h2>
            </div>
        </div>
    </div>
</div>
<section id="contact-us" class="contact-us my-4 section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-1"></div>
            <div class="col-lg-6 col-md-6 ">
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
         {{--  <form class="form" method="post" action="{{route('sendEmail')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" required="required"
                        class="form-control required">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" required="required"
                        class="form-control required">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="subject" placeholder="Subject" required="required"
                        class="form-control required">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea name="message" rows="4" placeholder="Your Message"
                        class="form-control required"></textarea>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <div class="form-group button contact_button">
                        <button type="submit" class="btn submitButtonContent">Send Message</button>
                    </div>
                </div>
            </div>
        </form> --}}
    </div>
    <!--/ End Contact Form -->
    <div class="col-lg-4 col-md-6 p_t10">
        <div class="contact">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Single Contact -->
                    <div class="single-contact">
                        <ul>
                            <li class="listIconCircle">
                                <i class="fa fa-map-marker"></i>
                            </li>
                            <li>
                                <h4>Our Location</h4>
                                <p>{{$dashboard_composer->address}}</p>
                            </li>
                        </ul>
                    </div>
                    <!--/ End Single Contact -->
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Single Contact -->

                    <div class="single-contact">
                        <ul>
                            <li class="listIconCircle">
                                <i class="fa fa-mobile"></i>
                            </li>
                            <li>
                                <h4>Contact Us</h4>
                                <p>Telephone: {{$dashboard_composer->phone}}</p>
                                <p>
                                    Email:<a href="mailto: {{$dashboard_composer->email}}">
                                        {{$dashboard_composer->email}}</a>
                                    </p>
                                </li>
                            </ul>

                        </div>
                        <!--/ End Single Contact -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<section id="map">
    <div>
        <div class="row">
            <div class="col-12">
                <iframe class="googleMap"
                src="{{$dashboard_composer->map}}"
                frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
@endsection