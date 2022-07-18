@extends('front.userdashboard')

@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>

    .bg-orange {
        background-color: #ff851b !important;
    }

    .bg-dark {
        background: #343a40;
    }

    .total-col {
        color: #fff;
    }

    .bg-red {
        background-color: #dd4b39 !important;
    }

    .bg-blue {
        background-color: #3b3bde !important
    }

    .bg-white {
        background-color: #fff !important;
        color: #000;
    }
</style>

@endpush

{{-- Latest user dashboard --}}

@section('content')

<section class="main__dashboard">

    <div class="container">
    @if(!empty($dashboard_composer->notification))
            <div id="notify" class="modal fade ">
        		<div class="modal-dialog modal-lg">
        			<div class="col-md-12">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h5 class="modal-title">Notice</h5>
        						<button type="button" class="close" data-dismiss="modal">&times;</button>
        					</div>
        					<div class="modal-body">
                            <br>
                                {!!$dashboard_composer->notification!!}
                                <br>
                                <span>Please Confirm our</span>  <a href="{{ route('get.bank-detail') }}">Bank Details</a>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
            @endif

        <div class="row">

            <div class="col-lg-12">
                <!-- <div class="table-wrapper">-->

                <!--    {{-- <ul class="personal-info">-->
                <!--        <li><span>Name :</span>-->
                <!--            <p>{{Auth::user()->name}}</p>-->
                <!--    </li>-->
                <!--    <li><span>Email :</span>-->
                <!--        <p>{{Auth::user()->email}}</p>-->
                <!--    </li>-->
                <!--    <li><span>Customer Number :</span>-->
                <!--        <p>{{Auth::user()->customerid}}</p>-->
                <!--    </li>-->
                <!--    <li><span>Phone :</span>-->
                <!--        <p>{{Auth::user()->phone}}</p>-->
                <!--    </li>-->
                <!--    </ul>-->
                <!--    <div class="note">-->
                <!--        <span>Note:</span>-->
                <!--        {!!$dashboard_composer->notice!!}-->
                <!--    </div> --}}-->
                <!--    <div id="app2">-->
                <!--        <div class="row">-->
                <!--            <div class="col-md-6">-->
                <!--                <h5>Welcome, {{Auth::user()->name}}</h5>-->
                <!--                <div class="welcomeSection">-->
                <!--                    <div class="welcomeContent">-->
                <!--                        <p class="welcomeContent__normal">exchange rate</p>-->
                <!--                        <p class="welcomeContent__small">1 AUD =</p>-->
                <!--                        <p> <span class="welcomeContent__small">NRs</span>-->
                <!--                            <span class="welcomeContent__large">{{ $composer__rate->rate }} </span>-->
                <!--                            <span class="welcomeContent__normal d-block">-->
                <!--                                ( as of-->
                <!--                                {{Carbon\Carbon::parse($composer__rate->updated_at)->format('D d, M Y ,H:i:s')}}-->
                <!--                                )-->
                <!--                            </span>-->
                <!--                        </p>-->
                <!--                        <a href="{{route('makeTransaction')}}"-->
                <!--                            class="btn btn__transparent btn__outline--light">send money</a>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="col-md-6">-->
                <!--                <h4>Our Bank Details</h4>-->
                <!--                {!!$dashboard_composer->bank__details!!}-->

                <!--                <h3>Notice</h3>-->
                <!--                {!! $dashboard_composer->notice !!}-->
                <!--            </div>-->
                <!--        </div>-->

                <!--        {{-- <h4 class="font-weight-bold">Welcome</h4>-->
                <!--        <h5 class="font-weight-bold">EXCHANGE RATE</h5>-->
                <!--        <p>1 Aud: NPR {{ $dashboard_composer->rate }} ( as-->
                <!--        of-->
                <!--        <span v-if="isLoading">-->
                <!--            ...)-->
                <!--        </span>-->

                <!--        </p> --}}-->

                <!--    </div>-->
                <!--</div> -->
                <section class="newsendmoney samecont">
                    <div class="container">
                        <div class="welcome">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="newexrate">
                                    <h5 class="custom-h5-client">Welcome, {{Auth::user()->name}}</h5>
                                    <h4>Today Exchange Rate</h4>
                                    <button class="btn btn-danger d-block m-auto custom-btn-mid">1 AUD = NPR {{ $composer__rate->rate }}</button>
                                    <p class="mt-2" style="margin:0;">  As of 
                                        {{Carbon\Carbon::parse($composer__rate->updated_at)->format('D d, M Y ,H:i:s')}}
                                        </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="newbtns">
                                <a href="{{ route('makeTransaction') }}" class="btn btn-primary sndmoney">Send Money</a><br>
                                <a href="{{ route('makeTransaction') }}" class="btn btn-primary trackremit">Track Your Remit</a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
                <section class="transaction-table samecont">
                    <div class="container">
                        <h4>Your Transaction:-</h4>
                       
                  

<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="item">
             <table class="table">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Date</th>
      <th scope="col">AUD</th>
      <th scope="col">Receiver</th>
       <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
</tbody>
</table>
          </div>
        </div>
        <div class="carousel-item">
            <div class="item">
              <table class="table">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Date</th>
      <th scope="col">AUD</th>
      <th scope="col">Receiver</th>
       <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
</tbody>
</table>
          </div>
        </div>
        
        
        
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>

      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous
</span>
      </a>
    </div>
</div>
</div>
</section>



                <!--<div class="table-wrapper-second" style="background: #FFFFFF;">-->
                <!--    <div>-->
                <!--        <div class="row" style="margin-top: 40px; padding: 20px 40px;">-->
                <!--            <h5 style="margin-bottom: 35px;">Dashboard</h5>-->
                <!--            <div class="col-md-12 d-flex flex-wrap justify-content-center">-->
                <!--                <a href="" class="custom-btn-db hover-custom-db text-center">-->
                <!--                    <div>-->
                <!--                        <div class="d-flex justify-content-center align-items-center client-dash-icon">-->
                <!--                            <i class="fa fa-university client-fa"></i>-->
                <!--                        </div>-->
                <!--                        <p style="margin: 1.2rem 0; font-weight: 600; color: #000">Bank Details</p>-->
                <!--                    </div>-->
                <!--                </a>-->

                <!--                <a href="" class="custom-btn-db hover-custom-db text-center">-->
                <!--                    <div>-->
                <!--                        <div class="d-flex justify-content-center align-items-center client-dash-icon">-->
                <!--                            <i class="fa fa-signal client-fa"></i>-->
                <!--                        </div>-->
                <!--                        <p style="margin: 1.2rem 0; font-weight: 600; color: #000">Transaction</p>-->
                <!--                    </div>-->
                <!--                </a>-->

                <!--                <a href="" class="custom-btn-db hover-custom-db text-center">-->
                <!--                    <div>-->
                <!--                        <div class="d-flex justify-content-center align-items-center client-dash-icon">-->
                <!--                            <i class="fa fa-paper-plane client-fa"></i>-->
                <!--                        </div>-->
                <!--                        <p style="margin: 1.2rem 0; font-weight: 600; color: #000">Send Money</p>-->
                <!--                    </div>-->
                <!--                </a>-->

                <!--                <a href="" class="custom-btn-db hover-custom-db text-center">-->
                <!--                    <div>-->
                <!--                        <div class="d-flex justify-content-center align-items-center client-dash-icon">-->
                <!--                            <i class="fa fa-user client-fa"></i>-->
                <!--                        </div>-->
                <!--                        <p style="margin: 1.2rem 0; font-weight: 600; color: #000">Receivers</p>-->
                <!--                    </div>-->
                <!--                </a>-->

                <!--                <a href="" class="custom-btn-db hover-custom-db text-center">-->
                <!--                    <div>-->
                <!--                        <div class="d-flex justify-content-center align-items-center client-dash-icon">-->
                <!--                            <i class="fa fa-university client-fa"></i>-->
                <!--                        </div>-->
                <!--                        <p style="margin: 1.2rem 0; font-weight: 600; color: #000">About Us</p>-->
                <!--                    </div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<div>-->
                <!--    <div class="transaction-box" >-->
                <!--        <div class="row" style="margin-top: 40px; padding: 20px 40px;">-->
                <!--            <div class="col-sm-12 col-md-6" style="background: #f3cf6c;">-->
                <!--            <div class="py-4">-->
                <!--                    <h2 class="client-dashboard-h2" style="color: red;">All Time Transaction</h2>-->
                <!--                    <div class="d-flex justify-content-around" style="border-bottom: 2px solid red; font-weight: bold;">-->
                <!--                        <h2 class="client-dashboard-h2 txt-bold">AUD</h2>-->
                <!--                        <h2 class="client-dashboard-h2 txt-bold"> $ {{$transactions->sum('remit_amount')}}</h2>-->
                <!--                    </div>-->
                <!--                    <div class="d-flex justify-content-around">-->
                <!--                        <h2 class="client-dashboard-h2">NPR</h2>-->
                <!--                        <h2 class="client-dashboard-h2"> {{$transactions->sum('npr')}}</h2>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="col-sm-12 col-md-6">-->
                <!--                <div class="py-4">-->
                <!--                    <h2 class="client-dashboard-h2" style="color: red;">This Month Transaction</h2>-->
                <!--                    <div class="d-flex justify-content-around" style="border-bottom: 2px solid red; font-weight: bold;">-->
                <!--                        <h2 class="client-dashboard-h2 txt-bold">AUD</h2>-->
                <!--                        <h2 class="client-dashboard-h2 txt-bold"> ${{$CurrentMonthTransaction->sum('remit_amount')}}</h2>-->
                <!--                    </div>-->
                <!--                    <div class="d-flex justify-content-around">-->
                <!--                        <h2 class="client-dashboard-h2">NPR</h2>-->
                <!--                        <h2 class="client-dashboard-h2"> {{$CurrentMonthTransaction->sum('npr')}}</h2>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="total-wrapper">
                    <div class="total-col bg-white">
                        <p>Rate bargraph</p>
                        <canvas id="myChart" width="400" height="400"></canvas>
                        {{-- <span>{{$transactions->count()}}</span> --}}
                    </div>
                    {{-- <div class="total-col bg-blue">
                        <p>Total Receivers</p>
                        <span>{{ auth()->user()->receivers()->count() }}</span>
                    </div> --}}
                </div>
                
                 <section class="transaction-table samecont">
                    <div class="container">
                        <h4>Receivers</h4>
                       
                  

<div class="container">
    <div id="carouselExampleIndicatorssd" class="carousel slide" data-ride="carousel">
      
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="item">
             <table class="table">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Name</th>
      <th scope="col">Last Transaction</th>
      <th scope="col">AUD</th>
       <th scope="col">NRS</th>
        <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
</tbody>
</table>
          </div>
        </div>
        <div class="carousel-item">
            <div class="item">
             <table class="table">
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Name</th>
      <th scope="col">Last Transaction</th>
      <th scope="col">AUD</th>
       <th scope="col">NRS</th>
        <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>20-Jan-2020</td>
      <td>500</td>
      <td>Ramesh Sharma</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
    <tr>
      <th scope="row">1</th>
      <td>Prem Kumari Rai</td>
      <td>22-Jan-2022</td>
      <td>100</td>
      <td>9500</td>
      <td>Delivered</td>
    </tr>
</tbody>
</table>
          </div>
        </div>
        
        
        
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicatorssd" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>

      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicatorssd" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous
</span>
      </a>
    </div>
</div>
</div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6 footerlocation">
              <ul>
                  <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Sundhara,Kathmandu</a></li>
                  <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>01498766/788776</a></li>
                  <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Sundhara,Kathmandu</a></li>
              </ul>  
            </div>
            <div class="col-md-5 footerlocation footersocail pull-right text-right">
                <h4>Follow us</h4>
              <ul>
                  <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                   <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              </ul>
              <p>Developed By:<a href="#">Web House</a></p>
            </div>
        </div>
    </div>
</footer>
            </div> <!-- col-lg-12 closing -->

        </div> <!-- row closing -->
    </div> <!-- Container Closing -->
    <!-- </div> -->
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    var app = new Vue({
            el: '#app2',
            created() {
                fetch('http://api.timezonedb.com/v2.1/get-time-zone?key=8J0U4WL66A7O&format=json&by=zone&zone=Australia/Sydney').then(res => res.json()).then(data => {
                    this.sydneyTime = data;
                    this.isLoading = false;
                });
                fetch('/all-rates').then(res => res.json()).then(data =>
                    {
                        this.chartData = {
                            type: 'line',
                            data: {
                                labels: data.data.map( (label, i) => this.getMomentDate(label.updated_at)),
                                datasets: [{
                                    label: 'Exchange Rate',
                                    data: data.data.map( (label, i) => label.rate ),
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.4)',
                                        'rgba(54, 162, 235, 0.4)',
                                        'rgba(255, 206, 86, 0.4)',
                                        'rgba(75, 192, 192, 0.4)',
                                        'rgba(153, 102, 255, 0.4)',
                                        'rgba(255, 159, 64, 0.4)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                    ],
                                    borderWidth: 1,
                                    barThickness: 30
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        display: true,
                                        ticks: {
                                            // beginAtZero: true,
                                            suggestedMin: 60, //min
                                            suggestedMax: 100 //max
                                        }
                                    }],
                                },
                            }
                        }
                        this.chartData && this.createChart('#myChart', this.chartData)
                    }
                );
            },
            data(){
                return {
                    sydneyTime: {},
                    isLoading: true,
                    chartData: {}
                }
            },
            methods:{
                getMomentDate(date) {
                    return moment(date).format('MMMM Do');
                },
                createChart(chartId,chartApp) {
                    const ctx = document.querySelector(chartId);
                    console.log(chartApp);
                    const myChart = new Chart(ctx, {
                        type: chartApp && chartApp.type,
                        data: chartApp && chartApp.data,
                        options: chartApp && chartApp.options,
                    });
                }
            }
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
@endpush

{{-- <section class="user__dashboard">
        <div class="container">
            <div class="user__dash-top">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-6">
                        <a class="text-dark" href="{{route('clientDashboard')}}">Dashboard</a>
</div>
<div class="col-lg-4 col-md-6 col-6">
    <p>Today's Rate: {{$dashboard_composer->rate}}</p>
</div>
<div class="col-lg-4 col-md-6 col-12">
    <div class="user__title">
        <ul class="user_button float-right">
            <li>
                <a href="{{route('makeTransaction')}}" class="btn btn-info">Make Transaction</a>
            </li>
            <li class="log_me_out">
                <h3>{{Auth::user()->name}} <i class="fa logout__icon fa-chevron-down"></i></h3>
                <div class="options" style="display:none">
                    <ul>
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

<section class="main__dashboard">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{route('editProfile',Auth::user()->id)}}" class="btn btn-success m_tb30 float-right">Edit
                    Profile</a>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{Auth::user()->name}}</td>
                        </tr>
                        <!-- <tr>
                                <th>Address</th>
                                <td>{{Auth::user()->address}}</td>
                            </tr> -->
                        <tr>
                            <th>Email</th>
                            <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{Auth::user()->phone}}</td>
                        </tr>
                        <tr>
                            <th>Customer Id</th>
                            <td>{{Auth::user()->customerid}}</td>
                        </tr>


                        <tr>
                            <th>Notice</th>
                            <td>{!!$dashboard_composer->notice!!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="list__transaction">
    <div class="container">
        <div class="overflow-x__auto">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Code</th>
                        <th scope="col">Receiver Name</th>
                        <th scope="col">Type</th>
                        <th>Status</th>
                        <th scope="col">amount($)</th>
                        <th scope="col">Rate</th>
                        <!-- <th scope="col">Number of transaction</th> -->
                        <th scope="col">Npr</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td scope="row">{{ Carbon\Carbon::parse($transaction->created_at)->format('j, M Y ') }}</td>
                        <td>{{$transaction->random_token}}</td>
                        <td>@if($transaction->type=='Bank Deposit')
                            {{$transaction->account_holder_name}}
                            @else
                            {{$transaction->full_name}}
                            @endif
                        </td>
                        <td>{{$transaction->type}}</td>
                        <td>@if($transaction->status==0)
                            Pending
                            @elseif($transaction->status==1)
                            Inprogress
                            @else
                            Delivered
                            @endif



                        </td>
                        <td>{{$transaction->remit_amount}}</td>
                        <td>{{$transaction->rate}}</td>
                        <td>{{$transaction->npr}}</td>
                    </tr>
                    <tr>
                        {{$transactions->links()}}
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>















--}}

{{--

{{ $transactions->sum('npr') }}
{{ $transactions->count()}}

{{ $received = $transactions->where('status', 2)}}
{{dd($received->count())}}

--}}


{{-- <table class="table">
                        <thead></thead>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{Auth::user()->name}}</td>
</tr>
<!-- <tr>
                               <th>Address</th>
                               <td>{{Auth::user()->address}}</td>
                           </tr> -->
<tr>
    <th>Email</th>
    <td>{{Auth::user()->email}}</td>
</tr>
<tr>
    <th>Phone</th>
    <td>{{Auth::user()->phone}}</td>
</tr>
<tr>
    <th>Customer Id</th>
    <td>{{Auth::user()->customerid}}</td>
</tr>

<tr>
    <th>Notice</th>
    <td>{!!$dashboard_composer->notice!!}</td>
</tr>
</tbody>
</table> --}}