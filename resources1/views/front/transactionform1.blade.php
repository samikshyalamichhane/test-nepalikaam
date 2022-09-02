@extends('front.userdashboard')

@push('styles')
<link rel="stylesheet" href="/backend/dist/css/image-uploader.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
     .image_cover {
        position: relative;
      }

      .cross-button {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        /* color: red; */
        text-align: center;
        width: 100%;
        height: 100%;
        /* animation-name: fadeInUp;
          animation-duration: .5s; */

      }

      .cross-button:hover {
        background-color: rgba(0, 0, 0, 0.39);
      }

      .cross-button .fa-times {
        font-size: 20px;
        padding-top: 20%;
        text-align: center;
        display: none;
        color: #e6e4e4;
      }

      .cross-button:hover>.fa-times {
        display: block;
      }
    /* circle loader starts */

    .loading {
        width: 100vw;
        height: 200vw;
        position: fixed;
        top: 0;
        left: 0;
        background: #eef3f7;
        z-index: 9999;
    }

    #wrapper {
        position: relative;
        /*background:#333;*/
        height: 100%;
    }

    .profile-main-loader {
        left: 50% !important;
        margin-left: -100px;
        position: fixed !important;
        top: 50% !important;
        margin-top: -100px;
        width: 45px;
        z-index: 9000 !important;
    }

    .profile-main-loader .loader {
        position: relative;
        margin: 0px auto;
        width: 200px;
        height: 200px;
    }

    .profile-main-loader .loader:before {
        content: "";
        display: block;
        padding-top: 100%;
    }

    .circular-loader {
        -webkit-animation: rotate 2s linear infinite;
        animation: rotate 2s linear infinite;
        height: 100%;
        -webkit-transform-origin: center center;
        -ms-transform-origin: center center;
        transform-origin: center center;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        margin: auto;
    }

    .loader-path {
        stroke-dasharray: 150, 200;
        stroke-dashoffset: -10;
        -webkit-animation: dash 1.5s ease-in-out infinite,
            color 6s ease-in-out infinite;
        animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
        stroke-linecap: round;
    }

    circle {
        stroke: #d81b1f;
    }

    @-webkit-keyframes rotate {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes rotate {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes dash {
        0% {
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -35;
        }

        100% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -124;
        }
    }

    @keyframes dash {
        0% {
            stroke-dasharray: 1, 200;
            stroke-dashoffset: 0;
        }

        50% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -35;
        }

        100% {
            stroke-dasharray: 89, 200;
            stroke-dashoffset: -124;
        }
    }

    @-webkit-keyframes color {
        0% {
            stroke: #d81b1f;
        }

        40% {
            stroke: #d81b1f;
        }

        66% {
            stroke: #d81b1f;
        }

        80%,
        90% {
            stroke: #d81b1f;
        }
    }

    @keyframes color {
        0% {
            stroke: #d81b1f;
        }

        40% {
            stroke: #d81b1f;
        }

        66% {
            stroke: #d81b1f;
        }

        80%,
        90% {
            stroke: #d81b1f;
        }
    }

    /* circle loader ends */
    .image-uploader .upload-text i {
        display: none;
    }
    .upload-text span {
        font-size: 12px
    }
.remit-detail input{
    width:45%;
}

</style>
@endpush

@section('content')



<div id="app">
<section class="newprocess">
<div id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
               
                <div class="row">
                    <div class="col-md-12 mx-0">
                    <div class="display__message"></div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger message">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div id="validation-errors" class="display__message">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> </div>
                    
                        <form id="upload-image-form" action="{{route('saveTransaction')}}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account">Account</li>
                                <li id="personal">Receiver</li>
                                <li id="payment">Paid Slip</li>
                                <li id="confirm">Payment</li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                   <div class="">
					<span>AUD</span>
				  </div>
                                    <input  class="test remit_amount" type="number" name="remit_amount"  step="any"
                                                    onkeyup="checkRemitAmount()" placeholder="How much AUD you want to send?" required/>
                                    <p>Service Charge:${{ $dashboard_composer->service_charge }}</p>
                                    <div class="">
					<span>So total paying out </span>
				  </div>
                                    <!-- <input type="text" name="uname" placeholder="$110"/> -->
                                    <input type="number" class="form-control sending_amount pull-right" readonly required />
                                    <p>Today's rate:Rs.{{ $composer__rate->rate }}</p>
                                     <div class="">
					<span>Receiver will receive</span>
				  </div>
                                    <input type="text" class="npr" name="npr" readonly required/>
                                    
                                </div>
                                <hr>
                                <input type="button" name="next" class="next action-button" value="Next"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card receiver commonp">
                                    <p>Fill detail of the receiver:</p>
                                    <div class="row mb-4" v-if="getPerson.length > 0">
                                        <div class="col-md-3">
                                            <label>Old Receivers:</label>
                                        </div>
                                        <div class="col-md-9">
                                        <select @change="findAccountHolder($event)" v-model="saved_person"
                                                    class="form-control">
                                                    <option disabled selected>Please select name</option>
                                                    <option v-for="(number) in getPerson" :value="number">
                                                        @{{number}}
                                                    </option>
                                                </select>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-3 pt">
                                            <label>Payment Type:</label>
                                        </div>
                                        <div class="col-md-9">
                                              <div class="selectoption">
       
        <select id="target" @change="onChange($event)" v-model="type" name="type"
                                                class="form-control type" required="">
            <option value="">Select..</option>
            <option value="Bank-Deposit">Bank Deposit</option>
                                                <option value="Remit">Remit</option>
                                                <option value="E-sewa">E-sewa</option>

            <select>
                <div id="Bank-Deposit" class="inv">
                    <div class="login-form">
                        <div class="newform">
                            <h5>New Receiver:-<a @click="clearSelection"
                                                    class="text-light mt-2 btn btn-sm btn-success">Clear
                                                    Selection</a></h5>
                            <div class="form-group row">
                                    <label for="full_name" class="col-md-3 col-form-label">Contact Number:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="full_name" class="form-control so" name="full-name" placeholder="Write Here"> -->
                                        <input name="contact_number" class="form-control contact_number"
                                                    type="number" :value="account_holder && account_holder.contact_number"
                                                    :readonly="getDisabled" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==10) return false">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="email_address" class="col-md-3 col-form-label">Full Name:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="email_address" class="form-control so" name="email-address" placeholder="Write Here"> -->
                                        <input :value="account_holder && account_holder.full_name" type="text"
                                                    :readonly="getDisabled" name="full_name" class="form-control full_name"
                                                    required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user_name" class="col-md-3 col-form-label">Acc Holder Name:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="user_name" class="form-control so" name="username" placeholder="Write Here"> -->
                                        <input type="text" name="account_holder_name"
                                                    :value="account_holder && account_holder.account_holder_name"
                                                    class="form-control account_holder_name" :readonly="getDisabled"
                                                    required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-3 col-form-label">Bank Name:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="phone_number" class="form-control so" placeholder="Write Here"> -->
                                        <input type="text" name="bank_name"
                                                    :value="account_holder && account_holder.bank_name"
                                                    class="form-control bank_name" :readonly="getDisabled" required="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="present_address" class="col-md-3 col-form-label">Bank Branch:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="present_address" class="form-control so" placeholder="Write Here"> -->
                                        <input :value="account_holder && account_holder.bank_branch" type="text"
                                                    name="bank_branch" :readonly="getDisabled"
                                                    class="form-control bank_branch" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permanent_address" class="col-md-3 col-form-label">Account Number:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="permanent_address" class="form-control so" name="permanent-address" placeholder="Write Here"> -->
                                        <input :value="account_holder && account_holder.account_number" type="text"
                                                    name="account_number" :readonly="getDisabled"
                                                    class="form-control account_number" />
                                    </div>
                                </div>
                        </div>
                </div>
                </div>
                </select>
                <!-- <div class="row mb-4" v-if="getPerson.length > 0">
                                        <div class="col-md-3">
                                            <label>Old Receivers:</label>
                                        </div>
                                        <div class="col-md-9">
                                        <select @change="findAccountHolder($event)" v-model="saved_person"
                                                    class="form-control">
                                                    <option disabled selected>Please select name</option>
                                                    <option v-for="(number) in getPerson" :value="number">
                                                        @{{number}}
                                                    </option>
                                                </select>
                                        </div>
                                        </div> -->
                
                <div id="E-sewa" class="inv"><div class="newform commonp">
                   <p>Upload Payment slip or proof.</p>
                   <h5>New Receiver:-</h5>
                   <div class="row mb-4" v-if="getPerson.length > 0">
                                        <div class="col-md-3">
                                            <label>Old Receivers:</label>
                                        </div>
                                        <div class="col-md-9">
                                        <select @change="findAccountHolder($event)" v-model="saved_person"
                                                    class="form-control">
                                                    <option disabled selected>Please select name</option>
                                                    <option v-for="(number) in getPerson" :value="number">
                                                        @{{number}}
                                                    </option>
                                                </select>
                                        </div>
                                        </div>
                         <h5>New Receiver:-<a @click="clearSelection"
                                                    class="text-light mt-2 btn btn-sm btn-success">Reset
                                                    </a></h5>
                         <div class="form-group row">
                                    <label for="full_name" class="col-md-3 col-form-label">Esewa Id:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="full_name" class="form-control so" name="full-name" placeholder="Write Here"> -->
                                        <input type="number" name="esewa_number"
                                                    class="form-control" required type="number"
                                                    pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==10) return false">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="email_address" class="col-md-3 col-form-label">Name:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="email_address" class="form-control so" name="email-address" placeholder="Write Here"> -->
                                        <input type="text" name="esewa_name"
                                                    class="form-control" required type="text">
                                    </div>
                                </div>
                               
                    </div></div>
                <div id="Remit" class="inv">
                    <div class="newform">
                         <h5>New Receiver:-<a @click="clearSelection"
                                                    class="text-light mt-2 btn btn-sm btn-success">Clear
                                                    Selection</a></h5>
                         <div class="form-group row">
                                    <label for="full_name" class="col-md-3 col-form-label">Contact Number:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="full_name" class="form-control so" name="full-name" placeholder="Write Here"> -->
                                        <input type="number" name="receiver_contact_number"
                                                    class="form-control receiver_contact_number" required type="number"
                                                    :readonly="getDisabled"
                                                    :value="account_holder && account_holder.receiver_contact_number"
                                                    pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==10) return false">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="email_address" class="col-md-3 col-form-label">Full Name<br>(<small>As per citizen</small>):</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="email_address" class="form-control so" name="email-address" placeholder="Write Here"> -->
                                        <input :value="account_holder && account_holder.full_name" type="text"
                                                    :readonly="getDisabled" name="full_name" class="form-control full_name"
                                                    required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="user_name" class="col-md-3 col-form-label">Pick-up district:</label>
                                    <div class="col-md-9">
                                        <!-- <input type="text" id="user_name" class="form-control so" name="username" placeholder="Write Here"> -->
                                        <input type="text" name="pick_up_district"
                                                    class="form-control pick_up_district" :readonly="getDisabled"
                                                    :value="account_holder && account_holder.pick_up_district" />
                                    </div>
                                </div>
                                
                                <!-- <div class="form-group row">
                                    <label for="present_address" class="col-md-3 col-form-label">Bank Branch:</label>
                                    <div class="col-md-9">
                                        <input type="text" id="present_address" class="form-control so" placeholder="Write Here">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permanent_address" class="col-md-3 col-form-label">Account Number:</label>
                                    <div class="col-md-9">
                                        <input type="text" id="permanent_address" class="form-control so" name="permanent-address" placeholder="Write Here">
                                    </div>
                                </div> -->
                    </div>
                </div><!--remit close-->
                </select>
   </div>
        </div>
                                        </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Submit"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card newupload">
                                    <p>Upload your payment slip/Transfered slip/Deposited Voucher<br> Or any proof of payemnt</p>
                                    <div id="input-images-2" style="padding-top: .5rem;"></div>
                                    
                                </div>
                               <!--<div class="form-group uploadfiles">-->
                               <!--            <input id="inputFile" class="file-upload form-control" type="file" accept="image/*" />-->
                                          
                               <!--        </div>-->
                               <!-- <input id="fileUpload" type="file" name="transfer_receipt[]"  multiple> -->
                               <div class="col-12">
                                            <div id="image-holder" class="d-lg-flex"></div>
                                        </div>
                              <!-- <div class="uploadfiles">
                                <label class="btn-btn-default">
                                    <div class="fa fa-upload fa-2x "></div>
                                    <input id="inputFile" class="file-upload" type="file" accept="image/*" />
                                </label>
                                </div> -->
                                <!--<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>-->
                                <button type="submit" class="btn btn-success">Upload</button>
                                <!-- <input type="button" name="make_payment" class="next saveReceiver action-button " value="Submit"/> -->
                            </fieldset>
                            <!-- <fieldset>
                                <div class="form-card commonp">
                                    <p>Success !</p>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                        </div>
                                    </div>
                                </div>
                            </fieldset> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></section>
   
</div>

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
            <br>
            {{ session('promo_code_message') }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="{{ route('clientDashboard') }}" class="btn btn-primary">Dashboard</a>
        </div>
      </div>
    </div>
</div>
<input type="hidden" class="selected__type" />
@endsection

@push('scripts')

<script src="{{asset('backend/dist/js/sweetalert.js')}}"></script>
<script>
@if(session('message'))

Swal.fire({
  title: 'Congratulations!!! ' +
          'Your Transaction Successful !!!',
  icon: 'success',
  html:
    'Thank You for doing business with us, Track your remit via ' +
    '<a href=" www.nepalikaam.com"> www.nepalikaam.com</a> ' +
    '>> Track your remit >>> Enter Customer number.Always remember us to send money to NEPAL.',
  button:'Ok'
})
@endif
</script>


<script>
    var rate = {{ $composer__rate->rate }}
    const SERVICE_CHARGE = {{ $dashboard_composer->service_charge }};
    const MAX_DEPOSIT_AMOUNT = {{ $dashboard_composer->transaction_limit_bank_deposit }}
    const MAX_REMIT_AMOUNT = {{ $dashboard_composer->transaction_limit_remit }}
    const MAX_ESEWA_AMOUNT = {{ $dashboard_composer->transaction_limit_esewa }}


    function checkRemitAmount(e) {
        const SELECTED_TYPE = $('.selected__type').val();
        const REMIT_AMOUNT = $('.remit_amount').val()
        console.log(REMIT_AMOUNT)
        $('.remit_bind').val(REMIT_AMOUNT)
        $('.sending_amount').val('');
       
        if(REMIT_AMOUNT <= 0) {
           $('.remit_amount').val('')
           $("input[name='npr']").val('')
           $('.remit_bind').val(REMIT_AMOUNT)
           $('.sending_amount').val('')

           alert('Pleas Enter the Valid Amount')
           return;
        }

       

        const SENDING_AMOUNT = REMIT_AMOUNT - SERVICE_CHARGE
        console.log(SENDING_AMOUNT)
        $('.sending_amount').val(SENDING_AMOUNT)
        const offer_price = "{{$composer__rate->offer_price}}";
        if(offer_price>0){
            if(SENDING_AMOUNT>= offer_price){
                rate = {{$composer__rate->offer_rate}};
            }else{
                rate = {{ $composer__rate->rate }}
            }    
        }
         $('#rate_amount').text(rate);
        const NPR = SENDING_AMOUNT * rate
        console.log(NPR)

        if(NPR < 0) {
            $('.remit_bind').val(REMIT_AMOUNT)
            $("input[name='npr']").val('')
            return
        }
        $("input[name='npr']").val(NPR.toFixed(2));
         // if(SELECTED_TYPE == '') {
        //   return;
        // }

        // if(SELECTED_TYPE == 'Bank-Deposit') {
        //     if(REMIT_AMOUNT > MAX_DEPOSIT_AMOUNT) {
        //        $('.remit_amount').val('')
        //        $("input[name='npr']").val('')
        //        $('.remit_bind').val(REMIT_AMOUNT)
        //        $('.sending_amount').val('')

        //        alert(`Maximum sending limit amount is $ ${MAX_DEPOSIT_AMOUNT}`)
        //        return;
        //    }
        // }

        // if(SELECTED_TYPE == 'E-sewa') {
        //     if(REMIT_AMOUNT > MAX_ESEWA_AMOUNT) {
        //        $('.remit_amount').val('')
        //        $("input[name='npr']").val('')
        //        $('.remit_bind').val(REMIT_AMOUNT)
        //        $('.sending_amount').val('')

        //        alert(`Maximum sending limit amount is $ ${MAX_ESEWA_AMOUNT}`)
        //        return;
        //    }
        // }

        // if(SELECTED_TYPE == 'Remit') {
        //     if(REMIT_AMOUNT > MAX_REMIT_AMOUNT) {
        //        $('.remit_amount').val('')
        //        $("input[name='npr']").val('')
        //        $('.remit_bind').val(REMIT_AMOUNT)
        //        $('.sending_amount').val('')

        //        alert(`Maximum sending limit amount is $ ${MAX_REMIT_AMOUNT}`)
        //        return;
        //     }
        // }
    }
    $(document).ready(function(){
      $(".form-row").on("submit", function() {
            $('.loading').removeClass('d-none')
          });
    });

</script>

<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="/backend/dist/js/image-uploader.min.js"></script>
<!-- production version, optimized for size and speed -->
{{-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}

<script>
    var app = new Vue({
    	el: "#app",
    	data() {
    		return {
    			type: "",
    			infos: [],
    			account_holder: null,
                max: 10,
                saved_person: '',
                persons:[],
                randomNumber: ''
    		};
        },
        created() {
            console.log(this.account_holder);
        },
    	methods: {
    		onChange() {
                fetch("/client/allinfo/" + this.type)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    this.infos = [];
                    this.infos.push(...data.data);
                    this.saved_person = '';
                    this.account_holder=null;
                    // this.receiver_contact_number = '';
                    // this.contact_number = '';
                    this.persons = this.infos && this.infos.map(info => info.type == 'Remit' ? info.full_name : info.account_holder_name)
                    console.log(this.persons)
                });
                // gets list of name of person
                // fetch(`/client/get-saveperson/${this.type}`).then(res => res.json()).then(data => {
                //     this.persons = data.data
                // })

    		},
    		findAccountHolder(e) {
    			return (this.account_holder =
    				this.infos && this.infos.find((info) => {
                        if(this.type == 'Remit') {
                            return info.full_name == e.target.value
                        } else {
                            return info.account_holder_name == e.target.value
                        }
                }));
    		},
            clearSelection() {
                this.account_holder = null;
                this.saved_person = '';
                this.randomNumber = '';
            },
            generateRandomNumber() {
                    var length = 7;
                    var result = '';
                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    var charactersLength = characters.length;
                    for ( var i = 0; i < length; i++ ) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return this.randomNumber = result;
            }
        },
        computed: {
            getPerson() {
                return this.persons && this.persons
            },
            getDisabled() {
                return this.account_holder == null ? false: true
            },
            receiverId() {
                return this.account_holder && this.account_holder.receiver__id ? this.account_holder.receiver__id : this.randomNumber;
            },
            showGenerateButton() {
                return this.account_holder && this.account_holder.receiver__id ? false : true
            }
        }
    });
</script>

<script>
    const success = "{{ session('message') }}";
    if (success) {
        $('#toastNotification').modal();
    }
</script>
<script>
    $(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            $(".fa-upload").css("color", "green");
        }else{
          $(".fa-upload").css("color", "black");
        }
    }
 
 
 $("#inputFile").change(function () {
        readURL(this);
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    
var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

    
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
});

$(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
});

$('.radio-group .radio').click(function(){
    $(this).parent().find('.radio').removeClass('selected');
    $(this).addClass('selected');
});

$(".submit").click(function(){
    return false;
})
    
});
</script>
<script type="text/javascript">
    document
        .getElementById('target')
        .addEventListener('change', function() {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'inv';
            }
            if (target !== null) {
                target.className = 'vis';
            }
        });
    </script>
<script>
    $(document).ready(function(){

        $('.apply__coupon_button').click(function() {
            $(this).remove()
            $('.promo_code').removeClass('d-none')
        })

        $('.type').change(function(){
            var value = $(this).val();
            getValueFromType(value);
            // alert(value);
            if(value ==  "Remit"){
                $('.bank').addClass('d-none');
                $('.remit').removeClass('d-none');

                $("input[name='account_holder_name']").val('').attr('required', false);
                $("input[name='receiver_contact_name']").val('').attr('required', false);
                $("input[name='bank_name']").val('').attr('required', false);
                $("input[name='bank_branch']").val('').attr('required', false);
                $("input[name='account_number']").val('').attr('required', false);

            }
            if(value ==  "Bank-Deposit"){
                $('.bank').removeClass('d-none');
                $('.remit').addClass('d-none');

                $("input[name='full_name']").val('').attr('required', false);
                $("select[name='type']").attr('required', false);

                $("input[name='receiver_contact_number']").val('').attr('required', false);
                $("input[name='pick_up_district']").val('').attr('required', false);

            }
            if(value == 'E-sewa') {
                $('.esewa').removeClass('d-none')
                // remove others types
                $('.bank').addClass('d-none');
                $('.remit').addClass('d-none');
            } else {
                $('.esewa').addClass('d-none')
            }
        });

        $('.check__promo__code').click(async function() {
            const URL = "{{ route('check.promocode') }}"
            const PROMO_CODE = $("input[name='promo_code_value']").val()

            if(PROMO_CODE == '') {
                alert('Please enter promo code')
            }
            const {data} = await axios.post(URL, {
                promo_code: PROMO_CODE
            })

            if(data.promo_code && data.promo_code.publish == 0) {
                alert('Promo code is not active')
            }

            $('.promo_code_message').html('').append(data.message)

            if(!data.status) {
                $("input[name='promo_code']").val(0)
                return ;
            }

            $("input[name='promo_code_value']").val('')
            const DISCOUNTED_AMOUNT = parseInt(data.promo_code.discounted_amount)
            const NPR = $("input[name='npr']").val()

            const AMOUNT_AFTER_PROMOCODE = parseInt(NPR) + (DISCOUNTED_AMOUNT * rate)
            if(AMOUNT_AFTER_PROMOCODE < 0) {
                alert('NPR cannot be less than 0')
                $("input[name='npr']").val(NPR)
                return;
            }

            $("input[name='promo_code']").val(1)
            $("input[name='npr']").val(AMOUNT_AFTER_PROMOCODE)
        })
    });
    $(document).ready(function(){
        $("#contact_number").inputmask({"mask": "9999999999"});
        $("#receiver_contact_number").inputmask({"mask": "9999999999"});
    });

    $('.saveReceiver').click(function(e){
        e.preventDefault();
        remit_amount=$('.remit_amount').val();
        type=$('.type').val();
        npr=$('.npr').val();
        contact_number=$('.contact_number').val();
        account_holder_name=$('.account_holder_name').val();
        bank_name=$('.bank_name').val();
        bank_branch=$('.bank_branch').val();
        account_number=$('.account_number').val();
        receiver_contact_number=$('.receiver_contact_number').val();
        full_name=$('.full_name').val();
        pick_up_district=$('.pick_up_district').val();
        
        $.ajax({
            method:'post',
            url: '{{route('saveReceiver')}}',
            data:{
                "_token": "{{ csrf_token() }}",
                remit_amount,
                type,
                // user_id,
                contact_number,
                account_holder_name,
                bank_name,
                bank_branch,
                account_number,
                receiver_contact_number,
                full_name,
                pick_up_district,
            },
            success:function(data){
                if(data.success) {
                    $('.display__message').html(`
                    <div class="alert alert-success alert-dismissible message">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        Receiver saved successfully!
                    </div>`)
                }
            },
            error: function(response) {
                console.log(response.responseJSON.errors)
                var validation_errors = JSON.stringify(response.responseJSON.errors);
            var response = JSON.parse(validation_errors);
            $('#validation-errors').html('');
            $.each( response, function( key, value) {
            $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
        });
          }
        });
    });

</script>

<script type="text/javascript">
    let data = document.getElementById('input-images-2')
    console.log(data)
    $(data).imageUploader({
            imagesInputName: 'transfer_receipt',
        });
    $(document).ready(function() {
       

        // var imagesPreview = function(input, placeToInsertImagePreview) {
            
        //   console.log('hello',input.files);
        //   console.log(placeToInsertImagePreview);
        //     if (input.files) {
        //         var filesAmount = input.files.length;

        //         for (i = 0; i < filesAmount; i++) {
        //             var reader = new FileReader();

        //             reader.onload = function(event) {
        //                 $(
        //                 $.parseHTML(`
        //                     <div class="image_cover" style="width : 150px; margin-right: 10px; margin-top: 10px" >
        //                         <div class="cross-button">
        //                             <div class="fa fa-times remove"></div>
        //                         </div>
        //                         <img src="${event.target.result}" class="remove__image img-fluid" />
        //                     </div>`)
        //                 ).appendTo(placeToInsertImagePreview).css({});
        //             }

        //             reader.readAsDataURL(input.files[i]);
        //         }
        //     }
        // };

        $('#fileUpload').on('change', function() {
            imagesPreview(this, 'div#image-holder');
        });

        $(document).on('click', '.cross-button', function(){
            $(this).parent('.image_cover').remove();
        });
    })
</script>

<script>
    function getValueFromType(value) {
        $('.selected__type').val(value)
    }
</script>


@endpush


{{--
                                    <div class="form-group">
                                        <p class="text-danger notes">
                                            Remit charge NPR 300 per 60,000 in Nepal.
                                            <br>
                                            Over 2 lac ABBS charge deducted from receiver amount per lakh NPR100
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <p class="text-uppercase group__title">OUR BANK DETAILS:</p>
                                        <p><span class="text-uppercase group__title">OUR BANK DETAILS:</span> <small>Global
                                                10</small></p>
                                        <p><span class="text-uppercase group__title">BSB:</span> <small>082057</small></p>
                                        <p>
                                            <span class="text-uppercase group__title">A/C:</span> <small>441157687</small>
                                        </p>

                                    </div> --}}