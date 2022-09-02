@extends('layouts.front')
@section('content')
<link rel="stylesheet" href="{{asset('front/css/innerpage.css')}}">
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image: url('{{asset('front/img/banner.jpg')}}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__list--item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumbs__list--item"><a href="#">Services</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section id="innerPage__section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="innerpage__heading text-center">
                    <h2 class="innerpage__heading__title">
                        Our Services
                    </h2>
                    <!--<p class="innerpage__heading__para mx-auto">-->
                    <!--    Lorem ipsum dolor sit amet consectetur adipisicing elit. Est animi illo molestias. Deserunt quod-->
                    <!--    suscipit aliquid sequi qui quaerat incidunt!-->
                    <!--</p>-->

                </div>
            </div>
        </div>
        <div class="row">
            @php($i=1)
            @foreach($services as $service)
            <div class="col-lg-6 mb_30">
                <div class="Wrapper">
                    <div class="serviceList">
                        <div class="serviceList__icon">
                            @if($i==1)
                            <i class="fa fa-plane serviceList__icon-i"></i>
                            @elseif($i==2)
                            <i class="fa fa-handshake-o serviceList__icon-i"></i>
                            @elseif($i==3)
                            <i class="fa fa-sort-amount-desc serviceList__icon-i"></i>
                            @else
                            <i class="fa fa-usd serviceList__icon-i"></i>
                            @endif
                        </div>
                        <h2 class="serviceList__title">{{$service->title}}</h2>
                        <p class="serviceList__para">{!!str_limit($service->description,200)!!}</p>
                        <div class="serviceList__link">
                            <a href="{{route('serviceInner',$service->slug)}}" class="serviceList__link-link">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @php($i++)
            @endforeach
            
        </div>
    </div>
</section>
@endsection