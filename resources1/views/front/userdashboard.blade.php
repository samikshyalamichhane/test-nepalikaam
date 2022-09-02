<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>User Dashboard</title>
   <link rel="shortcut icon" type="image/icon" href="{{asset('front/img/logo.png')}}">
   <link rel="stylesheet" href="{{asset('front/css/import.css')}}">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
   <link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
   <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
   <link rel="stylesheet" href="{{asset('front/css/user.css')}}">
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
      rel="stylesheet">
       <link rel="stylesheet" href="{{asset('front/css/jquery.jConveyorTicker.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/dist/css/AdminLTE.min.css')}}">
   @stack('styles')
<style>
.fixed{
    position:fixed;
    width:100%;
    top:0;
    z-index:99;
}
.d-demo-wrap {
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    font-size: 0;
    background: #fff;
    border-radius: 3px;
    box-shadow: inset 0 0 7px rgba(69, 78, 140, 0.5);
}

.d-demo-wrap .jctkr-label {
    height: 35px;
    padding: 0 10px;
    line-height: 2.8;
    background: rgb(10 92 126);
    font-size: 11px;
    color: #fff;
    cursor: default;
}

.d-demo-wrap .jctkr-label:hover {
    background: rgba(69, 78, 140, 0.9);
}

.js-conveyor-3 ul li {
    padding:5px 25px;
    position:relative;
}
.js-conveyor-3 ul li:before{
    content:'';
    width:10px;
    height:10px;
    border-radius:50%;
    position:absolute;
    background:#444;
    top:34%;
    left:0;
}
</style>
</head>

<body>
   <?php
$user = Auth::user();
?>

   <div class="whole-sec-wrapper open">
      <section class="user__dashboard">
         <div class="main-menu-wrapper">
            <a href="#" class="dash-logo">
               <img src="/front/img/logo.png">
               <h2>NK Services</h2>
            </a>
            <div class="icon-close1">
               <p>X</p>
            </div>

            <ul class="dash-sidebar">
               <li><a href="{{route('clientDashboard')}}">Dashboard</a></li>
               <li class="drop-menu"><a href="#">Profile <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                  <ul class="sub_menu">
                     <li><a href="{{route('viewProfile',Auth::user()->id)}}">View Profile</a></li>
                     <li><a href="{{route('editProfile',Auth::user()->id)}}">Edit Profile</a></li>
                  </ul>
               </li>
               <li><a href="{{route('getAllReceivers')}}">Receivers</a></li>
               <li class="drop-menu"><a href="#">Transaction<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                  <ul class="sub_menu">
                     <li><a href="{{route('makeTransaction')}}">Make Transaction</a></li>
                     <li><a href="{{route('allTransaction')}}">All Transaction</a></li>
                  </ul>
               </li>

               <li><a href="{{ route('get.bank-detail') }}">Bank Details</a></li>
            </ul>
         </div>

         <div class="container">
            <div class="user__dash-top">
               <div class="dash-header-wrapp">
                  <div class="dash">
                     <li class="menu-icon"><a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a></li>
                     {{-- <a class="dash-home" href="{{route('clientDashboard')}}">Dashboard</a> --}}
                  </div>
                 <!-- Button trigger modal -->
                 <div class="newmenuho">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newmenu">
  <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
</button>

<!-- Modal -->
<div class="modal fade" id="newmenu" tabindex="-1" role="dialog" aria-labelledby="newmenuLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <img src="/front/img/logo.png">
        <h5 class="modal-title" id="exampleModalLabel">NK Services</h5>
        
      </div>
      <div class="modal-body">
      <ul>
          <li><a href="#"><i class="fa fa-th-large" aria-hidden="true"></i>Dashboard</a></li>
          <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
          <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Receivers</a></li>
          <li><a href="#"><i class="fa fa-money" aria-hidden="true"></i>Receivers</a></li>
          <li><a href="#"><i class="fa fa-money" aria-hidden="true"></i>Bank Detail</a></li>
      </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>
</div>
</div>
                  <div class="rate" style="flex:1">
                     <p>Today's Rate:  {{ $composer__rate->rate }}</p>
                  </div>
                 
                  <div class="user-drop">
                     <div class="user__title">
                        <ul class="user_button float-right">
                           <li class="mkT">
                              <a href="{{route('makeTransaction')}}" class="btn btn-info">Make Transaction</a>
                           </li>
                           <li class="log_me_out">
                              <h3> <i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->name}}<i
                                    class="fa logout__icon fa-chevron-down"></i></h3>
                              <div class="options" style="display:none">
                                 <ul>
                                    <li>
                                       <a href="{{route('viewProfile',Auth::user()->id)}}">View Profile</a>
                                    </li>
                                    <li>
                                       <a href="{{route('editProfile',Auth::user()->id)}}">Edit Profile</a>
                                    </li>
                                    <li>
                                       <a href="{{route('clientLogOut')}}"> <span class="power_off">Logout
                                          </span>
                                          <i class="fa fa-power-off"></i></a>
                                    </li>
                                 </ul>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
           
         </div>
         
      </section>
      <section class="news-ticker newnews-wrap">
          <div class="container">
                <div class="row">
            <div class="col-sm-12">
        
                  <div class="d-demo-wrap mt-3">

        <!-- Plugin HTML begin -->
        <div class="jctkr-label newnews">
            <strong>Newsfeed</strong>
        </div>
        <div class="js-conveyor-3">
            <ul>
                <li>
                    <span>{!!$detail->news_feed!!}</span>
                </li>
                <!--<li>-->
                <!--    <span>Mauris interdum elit non sapien </span>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <span>Mauris interdum elit non sapien </span>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <span>Cras lorem augue facilisis a commodo</span>-->
                <!--</li>-->
            </ul>
        </div>
        <!-- Plugin HTML end -->

    </div>
 
               <!--<ul id="js-news" class="js-hidden">-->
               <!--     <li class="news-item">jQuery News Ticker now has support for multiple tickers per page!</li>-->
               <!--     <li class="news-item">jQuery News Ticker now has support for right-to-left languages!</li>-->
               <!--     <li class="news-item">jQuery News Ticker now has support for loading content via an RSS feed!</li>-->
               <!--     <li class="news-item">jQuery News Ticker now has an optional fade effect between items!</li>-->
               <!--     <li class="news-item">New updates have been made to jQuery News Ticker! Check below for more details!</li>-->
               <!--     <li class="news-item">jQuery News Ticker is now compatible with jQuery 1.3.2! See below for further details and for latest download.</li>-->
               <!--     <li class="news-item">Further updates to jQuery News Ticker are coming soon!</li>-->
               <!-- </ul>-->
                
            </div>
        </div>
          </div>
      </section>
       
      @yield('content')
           
   </div>

   <script src="{{asset('front/js/jquery.min.js')}}"></script>
   <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
   <script src="{{asset('front/js/custom.js')}}"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="{{asset('front/js/site.js')}}"></script>
   <script src="{{asset('front/js/vone.jquery.min.js')}}"></script>
   <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
   <script src="{{asset('front/js/slick.min.js')}}"></script>
     <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
         $('#notify').modal('show');
      });
   </script>
   <script src="{{asset('front/js/jquery.jConveyorTicker.min.js')}}"></script>
     <script>
        $(function() {
            $('.js-conveyor-3').jConveyorTicker({
                reverse_elm: true
            });
          });
   </script>
   <script>
    $('.tableslider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        swipe: false,
        infinite: true,
        default: true,
        arrow: true,
        responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
    </script>
   <script>
     $(window).on("scroll", function() {
        if ($(window).scrollTop()) {
            $('.user__dashboard').addClass('fixed');
    
        } else {
            $('.user__dashboard').removeClass('fixed');
         
        }
    })
        $('#example').DataTable();
   </script>


   @stack('scripts')

</body>

</html>