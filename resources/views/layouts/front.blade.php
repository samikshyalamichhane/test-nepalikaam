<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="NK Services is a ">
    <meta name="keywords" content="service, nk service, nk" />
    <meta name="author" content="Nk Services">
    <title>NK Services - Best remit in the town</title>
    <link rel="shortcut icon" type="image/icon" href="{{asset('front/img/logo.png')}}">
    <link rel="stylesheet" href="{{asset('front/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/import.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/mediaQuery.css')}}">
    
    @stack('styles')
    <style>
        .trial_button {
            position: fixed;
            right: -1px;
            top: 40%;
            background: #225bca;
            color: #fff;
            border-radius: 20px 0 0 20px;
            font-size: 11px;
            text-transform: uppercase;
            padding-top: 15px;
            padding-bottom: 15px;
            z-index: 4;
            animation: 1s steps(3, start) 0s infinite normal none running blink-background;
        }

        #checkRate.modal {
            overflow-x: hidden;
            overflow-y: hidden;
        }

        @keyframes blink-background {
            100% {
                background-color: #d0923f;
            }
        }
    </style>
</head>

<body>

    <div id="app">
        <section class="bg-strip px-lg-5">
            <div class="container-fluid">
                <div class="row">
                    <!--<div class="offset-md-3 col-3">-->
                         <div class="col-3">
                        <p>Welcome to Nepali Kaam!</p>
                    </div>
                    <!--<div class="col-6">-->
                    <div class="col-9">
                        <div class="social-box text-right">
                            <p>Follow Us</p>
                            <ul>
                                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                <li><a href=""><i class="fa fa-whatsapp"></i></a></li>
                                <li><a href=""><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <section id="site__header">
            
            <div class="container-fluid px-lg-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="logo-box d-flex align-items-center">
                            <div class="logobar desktop_show">
                                <a class="navbar-brand" href="{{route('home')}}">
                                    <img src="{{asset('front/img/logo.png')}}" class="logo" alt="logo">
                                    <span class="sitelogoTitle text-white">NK Services</span>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 col-md-12 col-12">

                        <div class="row d-none">
                            <div class="col-12">
                                <div class="topBar__Wrapper text-center text-lg-right">
                                    <div class="primaryButton topBar__button">
                                        @if(Auth::user())
                                        @if(Auth::user()->role!='client' && Auth::user()->publish=='approved')
                                        <a href="{{route('clientDashboard')}}"
                                            class="btn hvr-forward primaryButton__btn text-capitalize">dashboard</a>
                                        @else
                                        {{--
                                        <a href="{{route('login')}}" class="btn hvr-forward primaryButton__btn
                                        text-capitalize">login</a>
                                        --}}
                                        @endif
                                        @else
                                        {{--
                                    <a href="{{route('login')}}" class="btn hvr-forward primaryButton__btn
                                        text-capitalize">login</a>
                                        --}}
                                        @endif

                                    </div>
                                    {{--
                                <div class="secondaryButton topBar__button">
                                    <a href="{{route('register')}}" class="btn hvr-backward secondaryButton__btn
                                    text-capitalize">Register</a>
                                </div>
                                --}}
                            </div>
                        </div>
                    </div>
                    <div class="Wrapper scroll__nav">
                        <div id="nav">
                            <nav class="navbar navbar-expand-lg">
                                <ul class="display_inline_block">
                                    <li class="float-left">
                                        <div class="logobar mobile_show">
                                            <a class="navbar-brand" href="{{route('home')}}">
                                                <img src="{{asset('front/img/logo.png')}}" class="logo" alt="logo">
                                                <span class="sitelogoTitle text-white">NK Services</span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="float-right">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon">
                                                <i class="fa fa-bars text-white" aria-hidden="true"></i>
                                            </span>
                                        </button>

                                    </li>
                                </ul>

                                

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">


                                    <!-- <button class="btn btn-primary font-weight-bold">Click Here to Send</button> -->

                                    <ul class="navbar-nav ml-auto text-center">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="{{route('home')}}">Home<span
                                                    class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('login')}}">login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('services')}}">services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('contactUs')}}">contact</a>
                                        </li>
                                    </ul>
                                    <button class="btn btn-success font-weight-bold custom-header-send-money"><a href="{{route('login')}}" class="text-white">Click Here to Send Money</a></button>
                                </div>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    </section>
    @yield('content')
    <a @click="showModal" id="applyNow" class="btn font-weight-bold trial_button ">
        <ul>
            <li>T</li>
            <li>O</li>
            <li>D</li>
            <li>A</li>
            <li>Y</li>
            <li>S</li>
            <li>R</li>
            <li>A</li>
            <li>T</li>
            <li>E</li>
        </ul>
    </a>
    <section id="footer">
    <!-- <section id="footer"
        style="background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.2)),url('{{asset('front/img/footer.jpg')}}');"> -->
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="Wrapper d-flex justify-content-center">
                        <div class="footer__Column__Wrapper">
                            <h3 class="text-uppercase">contact us</h3>
                            <ul>
                                <li class="d-block"><i class="fa fa-street-view"></i>{{$dashboard_composer->address}}</li>
                                <li class="d-block"><i class="fa fa-tty"></i>{{$dashboard_composer->phone}}</li>
                                <li class="d-block"><i class="fa fa-info"></i>{{$dashboard_composer->email}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="Wrapper d-flex justify-content-center">
                        <div class="footer__Column__Wrapper">
                            <h3 class="text-uppercase">follow us:</h3>
                            <ul class="footer__social-icon">
                                <!-- <li><a href="https://www.google.com"><i class="fa fa-google-plus-official"></i></a></li> -->
                                <li data-toggle="tooltip" data-placement="top" title="Facebook"><a href="{{$dashboard_composer->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                <li data-toggle="tooltip" data-placement="top" title="Instagram"><a href="{{$dashboard_composer->instagram}}"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li data-toggle="tooltip" data-placement="top" title="Twitter"><a href="{{$dashboard_composer->twitter}}"><i class="fa fa-twitter"></i></a></li>
                                <li data-toggle="tooltip" data-placement="top" title="Whatsapp"><a href="{{$dashboard_composer->whatsapp}}"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                            <div>
                                <!--<a @click="showModal" id="applyNow" class="btn font-weight-bold trial_button ">-->
                                <!--    <ul>-->
                                <!--        <li>T</li>-->
                                <!--        <li>O</li>-->
                                <!--        <li>D</li>-->
                                <!--        <li>A</li>-->
                                <!--        <li>Y</li>-->
                                <!--        <li>S</li>-->
                                <!--        <li>R</li>-->
                                <!--        <li>A</li>-->
                                <!--        <li>T</li>-->
                                <!--        <li>E</li>-->
                                <!--    </ul>-->
                                <!--</a>-->
                                <div id="checkRate" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {{-- <h3 class="text-dark mb-0">Check rate</h3> --}}
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body text-dark">

                                                <div v-if="showError"
                                                    class="alert alert-danger alert-dismissible message">
                                                    <button @click="hideError" type="button" class="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    Incorrect password.
                                                </div>

                                                <div v-else>
                                                    <h5 class="font-weight-bold" v-if="showPassword">
                                                        Today's Rate: {{-- 1 Aud: NPR --}} {{ $composer__rate->rate }} <span
                                                            style="font-size: 17px;"><br />( as
                                                            of
                                                            {{Carbon\Carbon::parse($composer__rate->updated_at)->format('D d, M Y ,H:i:s')}}
                                                            )
                                                        </span>
                                                        {{-- @{{getTime(sydneyTime.datetime)}}) --}}
                                                    </h5>
                                                </div>

                                                <form class="mt-2" @submit.prevent="handleSubmit" method="post">
                                                    <label for="check_rate">
                                                        Enter Password to check rate or text us on 0424966039 for
                                                        password
                                                    </label>
                                                    <input type="password" v-model="password" name="password"
                                                        id="check_rate" class="form-control">
                                                    <button class="btn btn-sm btn-success mt-2">Check rate</button>
                                                    <a href="mailto:info@nepalikaam.com"
                                                        class="btn btn-success btn-sm mt-2">
                                                        Request password
                                                    </a>
                                                </form>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="Wrapper d-flex justify-content-center">
                        <div class="footer__Column__Wrapper">
                            <h3 class="text-uppercase">subscribe us</h3>
                            <form action="#" class="form-row align-items-center">
                                <div class="col-lg-2 col-md-2 col-2 ">
                                    <i class="fa fa-envelope newsletter__icon" aria-hidden="true"></i>
                                </div>
                                <div class="col-lg- col-md-8 col-6">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-lg-2 col-md-2 col-2 my-2">
                                    <button type="submit" class="btn primary__button">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <footer>
        <div class="copyright">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between">
                    <p class="text-md-left"> &copy; 2021 NK Services. All Rights Reserved </p>
                    <p class="text-md-right">Powered by: <a class="text-white" href="https://webhousenepal.com"
                            target="_blank">Web House Nepal</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <button class="btn btn-success fixed-bottom font-weight-bold custom-send-money"><a href="{{route('login')}}" class="text-white"> Click Here to Send Money </a></button>
    <button onclick="topFunction()" id="#top" class="scroll-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </button>
    </div>
    <script src="{{asset('front/js/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front/js/lightbox.js')}}"></script>
     <script src="{{asset('front/js/aos.js')}}"></script>
  
    <script src="{{asset('front/js/mainR.js')}}"></script>
    <script src="{{asset('front/js/mainL.js')}}"></script>
    <script src="{{asset('front/js/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://use.fontawesome.com/7bacaac040.js"></script>
     <script>
      AOS.init();
    </script>
    @stack('scripts')
    {{-- development vue --}}
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    {{-- production vue --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}
    <script>
        var checkPassword = '<?php echo $dashboard_composer->password; ?>';
        var app = new Vue({
            el: '#app',
            created() {
                // fetch('http://worldtimeapi.org/api/timezone/Australia/Sydney').then(res => res.json()).then(data => this.sydneyTime = data)

                fetch('http://api.timezonedb.com/v2.1/get-time-zone?key=8J0U4WL66A7O&format=json&by=zone&zone=Australia/Sydney').then(res => res.json()).then(data => {
                    this.sydneyTime = data
                })
            },
            data(){
                return {
                    password: '',
                    isError: false,
                    showPassword: false,
                    code: '',
                    remitUsers: [],
                    isremitUserError: false,
                    sydneyTime: {},
                    isLoading: true
                }
            },
            computed: {
                showError() {
                    return this.isError ? true : false
                },

            },
            methods:{
                handleSubmit() {
                    if(this.password === checkPassword) {
                        this.isError = false;
                        this.showPassword = true
                        this.password="";
                    } else {
                        this.isError = true;
                        this.showPassword = false
                        this.password="";
                    }
                },
                hideError() {
                    return this.isError = false
                },
                showModal() {
                    $('#checkRate').modal('show');
                },
                showTransactionInfo(e) {
                    e.preventDefault();
                    $('#transactionRemit').modal('show')
                    fetch(`/search-remit/${this.code}`,
                    ).then(res => res.json()).then( data => {
                        this.remitUsers = data.data;
                        this.isremitUserError = false;
                        this.isLoading = false;
                    }).catch(err => {
                        this.isremitUserError = true;
                        this.remitUsers = [];
                        this.isLoading = false;
                    })
                },
                momentDate(date) {
                    return moment(date).format('MMMM,Do YYYY');
                },
                setLoading() {
                    return this.isLoading = true
                },
                showStatus(status) {
                    if(status == 0) {
                        return 'Pending'
                    } else if(status == 1) {
                        return 'In Progress'
                    }
                    else {
                        return 'Delivered'
                    }
                }

            },
        });
    </script>

</body>

</html>