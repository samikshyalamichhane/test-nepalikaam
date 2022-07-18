@extends('layouts.front')

@push('styles')

<style>
    .modal-dialog {
        max-width: 800px;
        height: 100%;
        overflow-y: auto;
    }

    .modal-dialog::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    .modal-dialog::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    .modal-dialog::-webkit-scrollbar-thumb {
        background-color: #ccc;
    }

    button.close:hover,
    button.close {
        background-color: #e81f1f;
        color: #fff;
        opacity: 1 !important;
    }

    .modal-content {
        border: none;
    }


    #myModal .modal-content {
        background: transparent;
    }

    #transactionRemit button,
    #myModal .close__button {
        position: absolute;
        width: 40px;
        height: 40px;
        right: 16px;
        z-index: 99;
    }
</style>

@endpush

@section('content')

@if($popupads->count() > 0)
{{--
<div id="myModal" class="modal fade show custom-popup-slider-carousel" role="dialog" aria-modal="true" style="padding-right: 17px; display: block;">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close close__button" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
                <div class="owl-carousel owl-theme popupslider">
                    @foreach($popupads as $popupad)
                    <div class="item">
                        <a class="w-100" href="{{$popupad->link}}" target="_blank">
                            <img class="custom-popup-slider-carousel-img" src="/images/main/{{ $popupad->image }}" alt="as" class="w-100">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
--}}
{{--
<div id="myModal" class="modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body custom-modal-body">
                <div class="container custom-modal-container">
                    <div class="row">
                        <div class="col-md-12" style="height: 400px; width: 400px;">
                            <img src="http://nk.nepalikaam.com/images/main/1588548078.jpeg" alt="Modal IMAGE" style="height: auto; width: 100%;">
                        </div>
                        <div class="col-md-12" style="height: 400px; width: 400px;">
                            <img src="http://nk.nepalikaam.com/images/main/1592814788.jpeg" alt="Modal IMAGE" style="height: auto; width: 100%;">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
--}}
<div class="home-modal">
    <div id="myModal" class="modal  fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FFFFFF;">
                    <h5 class="modal-title">Notice</h5>
                    <button type="button" class="btn-danger close" data-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body" style="background:#fff;  height: 70vh;overflow-y: scroll;">
                    <div class="container">
                        <div class="row justify-content-center">
                             @foreach($popupads as $popupad)
                            <div class="col-sm-12 col-md-8" style="padding-right: 0; padding-left: 0;">
                                <a class="w-100" href="{{$popupad->link}}" target="_blank">
                                    <img class="d-block w-100" src="/images/main/{{ $popupad->image }}" alt="as" class="w-100">
                                </a>
                            </div>
                            @endforeach
                        
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif


<section id="banner">
    <div class="banner__carousel">
        <div class="owl-carousel owl-theme slider">
            @foreach($sliders as $slider)
            <div class="slider__item">
                <div class="slider__item__image">
                    <img src="{{asset('images/thumbnail/'.$slider->image)}}" alt="{{$slider->title}}"
                        class="slider__item__image-img">
                    <div class="absolute">
                        <div class="container">
                            <div class="slider__item__image__Description">
                                <h2 class="slider__item__image__Description-title">{{$slider->title}}</h2>
                                <p class="slider__item__image__Description-para">
                                    {{$slider->sub_title}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</section>
<section class="pos-relative">
    <div class="bg-background">
        <img src="/front/img/bg-wave.png">
    </div>
</section>
<section id="mission">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-12 col-sm-6 mission-row2">
                <div class="site-title">
                    <h3 class="site-title__title text-uppercase font-weight-bold text-center">our mission</h3>
                    <div class="feedback-breadcrumbs"></div>
                </div>
                <div class="Wrapper mt-lg-5">
                    <div class="mission__Description">
                        <p class="mission__Description-para">
                            {{$dashboard_composer->mission}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="image-box">
                    <img src="/front/img/mission.jpg" alt="mission image">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="send-money-wrap" style="background-image: url('{{asset('front/img/send-money.jpg')}}');background-position:bottom; background-size:cover;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
              <div class="col-lg-12  mb_47 no-gutters pt-lg-3 mt-lg-3">
                <div class="Wrapper">
                    <div class="section__Wrapper sm-newsletter ">
                       <div class="row">
                           <div class="col-sm-12 col-md-6">
                               <h2 class="text-uppercase">track your remit</h2>
                               <p class="text-white">Just Enter your Tracking Number to know where your money is and how long will it take  before you receive the money.</p>
                                <ul class="standard-list">
                                    <li><i class="fa fa-bullseye" aria-hidden="true"></i>Accurate</li>
                                    <li><i class="fa fa-shield" aria-hidden="true"></i>Safe & Secure</li>
                                    <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Reliable</li>
                                </ul>
                           </div>
                           <div class="col-sm-12 offset-md-2 col-md-4">
                               <p class="d-none result">asdkfldkf</p>
                                <div class="track__remit__table">
                                    <div id="transactionRemit" class="modal fade">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    {{-- <button type="button" class="close" data-dismiss="modal">×</button> --}}
                                                    <div v-if="isLoading" style="color: #000; padding: 12px;">
                                                        Loading...
                                                    </div>
                                                    <div v-else style="overflow-x: auto;">
                                                        <div v-if="isremitUserError"
                                                            class="alert alert-danger alert-dismissible message">
                                                            Data Not found
                                                        </div>
                                                        <table class="table" v-if="remitUsers.length > 0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Sent Date</th>
                                                                    <th scope="col">Delivered Date</th>
                                                                    <th scope="col">Receiver Name</th>
                                                                    <th scope="col">Type</th>
                                                                    <th scope="col">Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <template>
                                                                    <tr v-for="(remitUser, index) in remitUsers" :key="index">
                                                                        <td>@{{ momentDate(remitUser.created_at) }}
                                                                        </td>
                                                                        <td>@{{ remitUser.status == 2 ? momentDate(remitUser.updated_at) : 'N/A' }}
                                                                        </td>
                                                                        <td>@{{ remitUser.account_holder_name || remitUser.full_name }}
                                                                        </td>
                                                                        <td>@{{ remitUser.type }}</td>
                                                                        <td>@{{ showStatus(remitUser.status) }}
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <span @click="setLoading" data-dismiss="modal"
                                                        class="btn btn-danger">Close</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                </div>
                                @csrf
                                <div class="track-box">
                                    <input placeholder="Enter Customer Number" v-model="code" type="text" name="code"
                                        autocomplete="off" class="code form-control mx-auto">
                                    <p ><a href="#" @click="showTransactionInfo"
                                            class="text-white btn btn-success track">Click here to track!</a>
                                    </p>
                                </div>
                              
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-5 text-center">
                 <div class="services__title">
                    <h2 class="text-center text-black text-uppercase">OUR services</h2>
                    <span> </span>
                </div>
                <div class="feedback-breadcrumbs"></div>
                <h5 class="mt-3">Experience the best Service Via Nepali Kaam!</h5>
                <p class="mt-3">
                    We are multi-disciplinary digital agency. As a full-service agency, We Provide  various  services in different field suh as
                    Travel Business , Education Consulting, Tax Return and Money Transfer.
                </p>
            </div>
             <div class="col-12 col-sm-7">
               <div class="row">
                   <div class="col-6 col-lg-3">
                       <div class="Wrapper">
                            <div class="serviceIconBox text-center">
                                <div class="serviceIconBox__icon service-icon-one">
                                    <i class="fa fa-plane" aria-hidden="true"></i>
                                </div>
                                <h3 class="serviceIconBox__title service-h3-col-one my-3 text-capitalize">
                                    Air Ticketing
                                </h3>
                                 <!--<button class="btn hvr-shrink service-btn-three secondary__button"> -->
                                <button class="btn btn-success service-btn-three secondary__button">
                                    <a class="service-btn-a-one" href="tel:{{$dashboard_composer->phone}}">Call Us</a>
                                </button>
                            </div>
                        </div>
                   </div>
                   <div class="col-6 col-lg-3">
                       <div class="Wrapper">
                            <div class="serviceIconBox text-center">
                                <div class="serviceIconBox__icon service-icon-two">
                                    <i class="fa fa-university" aria-hidden="true"></i>
                                </div>
                                <h3 class="serviceIconBox__title service-h3-col-two  my-3 text-capitalize">
                                    Edu. Consulting
                                </h3>
                                 <!--<button class="btn hvr-shrink service-btn-three secondary__button"> -->
                                <button class="btn btn-success service-btn-three secondary__button">
                                    <a class="service-btn-a-two" href="tel:{{$dashboard_composer->phone}}">Call Us</a>
                                </button>
                            </div>
                        </div>
                   </div>
                   <div class="col-6 col-lg-3">
                       <div class="Wrapper">
                            <div class="serviceIconBox text-center">
                                <div class="serviceIconBox__icon service-icon-three">
                                    <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                                </div>
                                <h3 class="serviceIconBox__title service-h3-col-three my-3 text-capitalize">
                                    Tax Return
                                </h3>
                                 <!--<button class="btn hvr-shrink service-btn-three secondary__button"> -->
                                <button class="btn btn-success service-btn-three secondary__button">
                                    <a class="service-btn-a-three" href="{{route('contactUs')}}">Tax Return</a>
                                </button>
                            </div>
                        </div>
                   </div>
                   <div class="col-6 col-lg-3">
                       <div class="Wrapper">
                            <div class="serviceIconBox text-center">
                                <div class="serviceIconBox__icon service-icon-four">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                </div>
                                <h3 class="serviceIconBox__title service-h3-col-four my-3 text-capitalize">
                                    Money Transfer
                                </h3>
                                 <!--<button class="btn hvr-shrink service-btn-three secondary__button"> -->
                                <button class="btn btn-success service-btn-three secondary__button">
                                    <a class="service-btn-a-four" href="{{route('login')}}">Login</a>
                                </button>
                            </div>
                        </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</section>

<!--<section id="services">-->
 <!--<section id="services" style="background-image: url('{{asset('front/img/service.png')}}')"> -->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-12 services__title">-->
<!--                <h2 class="text-center text-black text-uppercase">OUR services</h2>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="feedback-breadcrumbs"></div>-->
<!--        <div class="row service-row">-->
<!--            <div class="col-lg-3 col-md-3 col-sm-6 services-col-one" data-aos="fade-up" data-aos-delay="300">-->
<!--                <div class="Wrapper">-->
<!--                    <div class="serviceIconBox text-center">-->
<!--                        <div class="serviceIconBox__icon service-icon-one">-->
<!--                            <i class="fa fa-plane" aria-hidden="true"></i>-->
<!--                        </div>-->
<!--                        <h3 class="serviceIconBox__title service-h3-col-one my-3 text-capitalize">-->
<!--                            Air Ticketing-->
<!--                        </h3>-->
<!--                         <button class="btn hvr-shrink service-btn-three secondary__button"> -->
<!--                        <button class="btn btn-success service-btn-three secondary__button">-->
<!--                            <a class="service-btn-a-one" href="tel:{{$dashboard_composer->phone}}">Call Us</a>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-3 col-md-3 col-sm-6 services-col-two" data-aos="fade-up" data-aos-delay="500">-->
<!--                <div class="Wrapper">-->
<!--                    <div class="serviceIconBox text-center">-->
<!--                        <div class="serviceIconBox__icon service-icon-two">-->
<!--                            <i class="fa fa-university" aria-hidden="true"></i>-->
<!--                        </div>-->
<!--                        <h3 class="serviceIconBox__title service-h3-col-two  my-3 text-capitalize">-->
<!--                            Edu. Consulting-->
<!--                        </h3>-->
<!--                         <button class="btn hvr-shrink service-btn-three secondary__button"> -->
<!--                        <button class="btn btn-success service-btn-three secondary__button">-->
<!--                            <a class="service-btn-a-two" href="tel:{{$dashboard_composer->phone}}">Call Us</a>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-3 col-md-3 col-sm-6 services-col-three" data-aos="fade-up" data-aos-delay="700">-->
<!--                <div class="Wrapper">-->
<!--                    <div class="serviceIconBox text-center">-->
<!--                        <div class="serviceIconBox__icon service-icon-three">-->
<!--                            <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>-->
<!--                        </div>-->
<!--                        <h3 class="serviceIconBox__title service-h3-col-three my-3 text-capitalize">-->
<!--                            Tax Return-->
<!--                        </h3>-->
<!--                         <button class="btn hvr-shrink service-btn-three secondary__button"> -->
<!--                        <button class="btn btn-success service-btn-three secondary__button">-->
<!--                            <a class="service-btn-a-three" href="{{route('contactUs')}}">Tax Return</a>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-3 col-md-3 col-sm-6 services-col-four" data-aos="fade-up" data-aos-delay="900">-->
<!--                <div class="Wrapper">-->
<!--                    <div class="serviceIconBox text-center">-->
<!--                        <div class="serviceIconBox__icon service-icon-four">-->
<!--                            <i class="fa fa-usd" aria-hidden="true"></i>-->
<!--                        </div>-->
<!--                        <h3 class="serviceIconBox__title service-h3-col-four my-3 text-capitalize">-->
<!--                            Money Transfer-->
<!--                        </h3>-->
<!--                         <button class="btn hvr-shrink service-btn-three secondary__button"> -->
<!--                        <button class="btn btn-success service-btn-three secondary__button">-->
<!--                            <a class="service-btn-a-four" href="{{route('login')}}">Login</a>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<section id="money" class="send-money-wrap" style="background-image: url('{{asset('front/img/send-money.jpg')}}');background-position:bottom; background-size:cover;">
     <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 no-gutters">
                <div class="Wrapper">
                    <div class=" text-center">
                        <div class="row">
                            <div class="col-8"><h2 class="text-uppercase">send money online</h2></div>
                            <div class="col-4"><p><a href="{{route('login')}}" class="btn btn-success">Click here to send!</a></p></div>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>

    </div>
</section>
<section id="feedback">
    <div class="container">
        <h2 class="text-center text-uppercase feedback-title">Good words from our clients</h2>
        <div class="feedback-breadcrumbs"></div>
        <!--<p class="text-center"> Good words from our valued customers.</p>-->
        

            <div class="owl-carousel owl-theme custom-owl-carousel-feedback">

                    @foreach($testimonials as $test)
                    <div class="item text-center feedback-item-boxshadow">
                        <div class="feedback-carousel-img">
                            <img class="feedback-img__image" src="{{asset('images/listing/'.$test->image)}}" alt="IMAGE">
                        </div>
                        <div>
                            <div class="feedback-description">
                                <p style="font-weight: bold; margin: 0px">{{$test->name}}</p>
                            </div>
                            <i class="fa fa-quote-left feedback-fa"></i>
                            <p style=" word-break: break-word;">
                                {!! $test->description !!}
                            </p>
                            <!--<i class="fa fa-quote-right feedback-fa"></i>-->
                        </div>
                    </div>
                    @endforeach



                </div> {{-- Row Closing --}}
            </div>

   {{-- Container Closing --}}
</section>

<section id="advertisement">
    <div class="container">
        <h2 class="text-center text-capitalize">advertisement</h2>
        <p class="advertisement-para text-center">
            {{$dashboard_composer->advertisement}}
        </p>
    </div>
</section>

@endsection

@push('scripts')

<script>
    // slider();
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    $(document).ready(function(){
        $('#myModal').modal('show');
    });
    $(document).ready(function(){

// $('.track').click(function(e){
//     e.preventDefault();
//     code=$('.code').val();
//     $.ajax({
//         method:'post',
//
//         data:{code:code},
//         success:function(data){
//             if(data.result == 'fail'){
//                     $('.result').removeClass('d-none');

//                     $('.result').html('not found');
//                     $('.result').fadeOut(3000);

//             }else{
//                 console.log(data.data);
//                 $('.result').removeClass('d-none');

//                 if(data.data.status== 0){
//                     $('.result').html('Status:pending');
//                     $('.result').fadeOut(3000);
//                 }
//                 if(data.data.status== 1){
//                     $('.result').html('Status: on Process');
//                     $('.result').fadeOut(3000);
//                 }
//                 if(data.data.status== 2){
//                     $('.result').html('Status: Delivered');
//                     $('.result').fadeOut(3000);
//                 }

//             }
//         }
//     });
// });
});
</script>
@endpush