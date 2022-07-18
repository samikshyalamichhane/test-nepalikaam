@extends('layouts.front')
@section('content')
<link rel="stylesheet" href="{{asset('front/css/innerpage.css')}}">
<div class="breadcrumbs overlay" data-stellar-background-ratio="0.7" style="background-image: url('{{asset('front/img/banner.jpg')}}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__list--item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumbs__list--item"><a href="{{route('services')}}">Services</a></li>
                    <li class="breadcrumbs__list--item"><a href="#">{{$detail->title}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section id="innerPage__section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="innerpage__heading">
                    <h2 class="innerpage__heading__title">
                        {{$detail->title}}
                    </h2>
                </div>
                <div class="innerpage__Description">
                    <p class="text-justify">
                        {!!$detail->description!!}
                    </p>
                </div>
            </div>
            <!-- <div class="col-lg-4 col-md-6 col-12">
                <div class="inner-section-area">
                    <div class="sidebar-widget">
                        <h3>Other Services</h3>
                        <div class="recent-post-widget">
                            <?php  for ($i=0; $i <3; $i++) {
                            ?>
                            <div class="recent-posts-content clearfix">
                                <div class="image-recent-post">
                                    <a href="servicesInner.php">
                                        <img src="img/slider/<?php echo $i+1; ?>.jpg" alt="recent img">
                                    </a>
                                </div>
                                <div class="date-title-recent-post">
                                    <span class="recent-post-title">
                                        <a href="servicesInner.php">Service <?php echo $i; ?></a>
                                    </span>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
@endsection