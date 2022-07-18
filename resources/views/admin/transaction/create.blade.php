@extends('layouts.admin')
@section('title','Transaction Create')
@push('styles')
<style>
	.mt-2 {
		margin-top: 1rem;
	}
</style>
@endpush
@section('content')
<section class="content-header">
	<h1>Transaction<small>create</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Transaction</a></li>
		<li><a href="">Create</a></li>
	</ol>
</section>
<div class="content">
	@if (count($errors) > 0)
	<div class="alert alert-danger message">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif

	@if(Session::has('message'))
	     <div class="alert alert-success alert-dismissible message">
	         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	             <span aria-hidden="true">&times;</span>
	         </button>
	         {!! Session::get('message') !!}
	     </div>
   @endif


  @if(Session::has('promo_code_message'))
     <div class="alert alert-{{ session('promo_code_type') ?? 'success' }} alert-dismissible message">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         {!! Session::get('promo_code_message') !!}
     </div>
  @endif
	<div id="app">
		<form method="post" action="{{route('transaction.store')}}" enctype="multipart/form-data" novalidate>
			{{csrf_field()}}
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header with-heading">
							<h3 class="box-title">Add Transaction</h3>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-8">
									<div class="form-group">
			                        	<div class="row justify-content-center">
			                        		<div class="col-md-4">
			                            		<label for="">Customer ID</label>
			                            	</div>
			                            	<div class="col-md-8">
			                            		<input type="number" class="form-control" name="customerid">
			                            	</div>
			                        	</div>
			                        </div>
			                        <div class="form-group">

			                            <div class="row justify-content-center">

			                                <div class="col-md-4">
			                                    <label>Payment Type: <span class="text-danger">*</span></label>
			                                </div>
			                                <div class="col-md-8">
			                                    <select @change="onChange($event)" v-model="type" name="type" class="form-control type" required="">
			                                        <option></option>
			                                        <option value="Bank-Deposit">Bank Deposit</option>
			                                        <option value="Remit">Remit</option>
																 <option value="E-sewa">E-sewa</option>
			                                    </select>
			                                </div>
			                            </div>
			                        </div>
			                        <div class="bank d-none">
												<div class="form-group" v-if="getPerson.length > 0">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Old Receivers: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<select @change="findAccountHolder($event)" v-model="saved_person"
																	 class="form-control">
																	 <option disabled selected>Please select name</option>
																	 <option v-for="(number) in getPerson" :value="number">
																		  @{{number}}
																	 </option>
																</select>
																<a @click="clearSelection"
																	 class="text-light mt-2 btn btn-sm btn-success">Clear
																	 Selection</a>
														  </div>
													 </div>
												</div>
												<div class="form-group">
													 <div class="row justify-content-center">


														  <div class="col-lg-4 col-12">
																<label>Receiver Contact Number: <span class="text-danger">*</span></label>
														  </div>

														  <div class="col-lg-8 col-12">
																<input name="contact_number" class="form-control contact_number"
																	 type="number" :value="account_holder && account_holder.contact_number"
																	 :readonly="getDisabled" pattern="/^-?\d+\.?\d*$/"
																	 onKeyPress="if(this.value.length==10) return false">
														  </div>
													 </div>
												</div>
												<div class=" form-group">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Account Holder Name: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12col-6">
																<input type="text" name="account_holder_name"
																	 :value="account_holder && account_holder.account_holder_name"
																	 class="form-control account_holder_name" :readonly="getDisabled"
																	 required />
														  </div>
													 </div>
												</div>

												<div class="form-group">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Bank Name: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<input type="text" name="bank_name"
																	 :value="account_holder && account_holder.bank_name"
																	 class="form-control bank_name" :readonly="getDisabled" required="" />
														  </div>
													 </div>
												</div>
												<div class="form-group">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Bank Branch: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<input :value="account_holder && account_holder.bank_branch" type="text"
																	 name="bank_branch" :readonly="getDisabled"
																	 class="form-control bank_branch" />
														  </div>
													 </div>
												</div>
												<div class="form-group">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Account Number: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<input :value="account_holder && account_holder.account_number" type="text"
																	 name="account_number" :readonly="getDisabled"
																	 class="form-control account_number" />
																<small>please double check</small>
														  </div>
													 </div>
												</div>

										  </div>
											<div class="remit d-none">
												<div class="form-group" v-if="getPerson.length > 0">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Old Receivers: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<select @change="findAccountHolder($event)" v-model="saved_person"
																	 class="form-control">
																	 <option disabled selected>Please select name</option>
																	 <option v-for="(number) in getPerson" :value="number">
																		  @{{number}}
																	 </option>
																</select>
																<a @click="clearSelection"
																	 class="btn mt-2 text-light btn-sm btn-success">Clear
																	 Selection</a>
														  </div>
													 </div>
												</div>
												<div class="form-group">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Receiver Contact Number: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<input type="number" name="receiver_contact_number"
																	 class="form-control receiver_contact_number" required type="number"
																	 :readonly="getDisabled"
																	 :value="account_holder && account_holder.receiver_contact_number"
																	 pattern="/^-?\d+\.?\d*$/"
																	 onKeyPress="if(this.value.length==10) return false">
														  </div>
													 </div>
												</div>
												<div class="form-group">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Full Name: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<input :value="account_holder && account_holder.full_name" type="text"
																	 :readonly="getDisabled" name="full_name" class="form-control full_name"
																	 required />
														  </div>
													 </div>
												</div>

												<div class="form-group">
													 <div class="row justify-content-center">
														  <div class="col-lg-4 col-12">
																<label>Pick up District: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-lg-8 col-12">
																<input type="text" name="pick_up_district"
																	 class="form-control pick_up_district" :readonly="getDisabled"
																	 :value="account_holder && account_holder.pick_up_district" />
																<small>current address</small>
														  </div>
													 </div>
												</div>
										  </div>

											{{-- Esewa --}}
											<div class="esewa d-none">
												<div class="form-group">
													 <div class="row justify-content-center">
														  <div class="col-md-4 col-12">
																<label>Esewa Number: <span class="text-danger">*</span></label>
														  </div>
														  <div class="col-md-8 col-12">
																<input type="number" name="esewa_number"
																	 class="form-control" required type="number"
																	 pattern="/^-?\d+\.?\d*$/"
																	 onKeyPress="if(this.value.length==10) return false">
														  </div>
													 </div>
												</div>
										  </div>
			                        <div class="form__divider">
			                            <div class="form-group">
			                                <div class="row justify-content-center">
			                                    <div class="col-md-4">
			                                        <label>REMIT AMOUNT $:<span class="text-danger">*</span></label>
			                                    </div>
												<div class="col-md-8">
			                                        <input type="number" name="remit_amount" class="form-control remit_amount" step="any" onkeyup="checkRemitAmount()" />
			                                        <small>including ${{$dashboard->service_charge}} service charge.</small>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>

									<div class="form-group">
												<button type="button" class="btn btn-outline-dark apply__service_button">Apply Service Charge</button>
										  	</div>
											 <div class="form-group row justify-content-center service_code d-none">
													<div class="col-md-4">
														 <label>SEPERATE SERVICE CHARGE: </label>
														 <br>
														 <span>(!! REMEMBER IF YOU DON'T CHOOSE THIS. DEFAULT SERVICE CHARGE IS Automatically ADDED !!)</span>
													</div>
													<div class="col-md-8">
														<div class="input-group mb-3">
															<input type="text" name="service_code_value" class="form-control" placeholder="Service Charge" >
															<span class="input-group-addon btn btn-outline-secondary apply__service__code">Apply</span>
														</div>
													  <p class="text-primary service_charge_message"></p>
													</div>
											 </div>

											<div class="form-group">
												<button type="button" class="btn btn-outline-dark apply__coupon_button">Apply Coupon</button>
										  	</div>
											 <div class="form-group row justify-content-center promo_code d-none">
													<div class="col-md-4">
														 <label>PROMO CODE: </label>
													</div>
													<div class="col-md-8">
														<div class="input-group mb-3">
															<input type="text" name="promo_code_value" class="form-control" placeholder="Promo code" >
															<span class="input-group-addon btn btn-outline-secondary check__promo__code">Check</span>
														</div>
													  <p class="text-primary promo_code_message"></p>
													  <input type="hidden" name="promo_code" class="d-none" />
													</div>
											 </div>

			                        <div class="form-group">
			                            <div class="row justify-content-center">
			                                <div class="col-md-4">
			                                    <label>NPR: <span class="text-danger">*</span></label>
			                                    
			                                    <p >Rate: NRS <span id="rate">{{$rate->rate}}</span></p>
			                                </div>
			                                <div class="col-md-8">
			                                    <input type="text" name="npr" class="form-control npr" readonly="" />
			                                </div>
			                            </div>
			                        </div>

			                       <!--  <div class="form-group">
			                            <div class="row justify-content-center">
			                                <div class="col-md-4">
			                                    <label>Transfer Receipt: <span class="text-danger">*</span></label>
			                                </div>
			                                <div class="col-md-8">
			                                    <div class="input-group">
			                                          <div class="custom-file">
			                                            <input type="file" class="custom-file-input" id="inputGroupFile04" name="transfer_receipt" required="">
			                                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
			                                          </div>
			                                    </div>
			                                </div>
			                            </div>
			                        </div> -->
			                        <div class="form-group">
			                            <button type="submit" class="btn btn-info submit__button">Submit</button>
			                        </div>
			                        {{--
			                        <div class="form__divider">
			                            <div class="form-group">
			                                <a href="#back" class="btn submit__button">Back</a>
			                            </div>
			                        </div>
			                        --}}
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>
</div>

<input type="hidden" class="selected__type" />

@endsection
@push('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


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
				const CUSTOMER_ID = $("input[name='customerid']").val()
					fetch("/admin/" + CUSTOMER_ID + "/allinfo/" + this.type)
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
  	 var rate = {{ $composer__rate->rate }}
    const SERVICE_CHARGE = {{ $dashboard_composer->service_charge }};
    const MAX_DEPOSIT_AMOUNT = {{ $dashboard_composer->transaction_limit_bank_deposit }}
    const MAX_REMIT_AMOUNT = {{ $dashboard_composer->transaction_limit_remit }}
    const MAX_ESEWA_AMOUNT = {{ $dashboard_composer->transaction_limit_esewa }}


    function checkRemitAmount(e) {
        const SELECTED_TYPE = $('.selected__type').val();
        const REMIT_AMOUNT = $('.remit_amount').val()
        $('.remit_bind').val(REMIT_AMOUNT)
        $('.sending_amount').val('')

        if(REMIT_AMOUNT <= 0) {
           $('.remit_amount').val('')
           $("input[name='npr']").val('')
           $('.remit_bind').val(REMIT_AMOUNT)
           $('.sending_amount').val('')

           alert('Cannot enter less than 0 or empty')
           return;
        }

        if(SELECTED_TYPE == '') {
          return;
        }

        if(SELECTED_TYPE == 'Bank-Deposit') {
            if(REMIT_AMOUNT > MAX_DEPOSIT_AMOUNT) {
               $('.remit_amount').val('')
               $("input[name='npr']").val('')
               $('.remit_bind').val(REMIT_AMOUNT)
               $('.sending_amount').val('')

               alert(`Cannot enter more than ${MAX_DEPOSIT_AMOUNT}`)
               return;
           }
        }

        if(SELECTED_TYPE == 'E-sewa') {
            if(REMIT_AMOUNT > MAX_ESEWA_AMOUNT) {
               $('.remit_amount').val('')
               $("input[name='npr']").val('')
               $('.remit_bind').val(REMIT_AMOUNT)
               $('.sending_amount').val('')

               alert(`Cannot enter more than ${MAX_ESEWA_AMOUNT}`)
               return;
           }
        }

        if(SELECTED_TYPE == 'Remit') {
            if(REMIT_AMOUNT > MAX_REMIT_AMOUNT) {
               $('.remit_amount').val('')
               $("input[name='npr']").val('')
               $('.remit_bind').val(REMIT_AMOUNT)
               $('.sending_amount').val('')

               alert(`Cannot enter more than ${MAX_REMIT_AMOUNT}`)
               return;
            }
        }
        const SENDING_AMOUNT = REMIT_AMOUNT - SERVICE_CHARGE
        $('.sending_amount').val
        const offer_price = "{{$rate->offer_price}}";
        if(offer_price>0){
            if(SENDING_AMOUNT>= offer_price){
                rate = {{$rate->offer_rate}};
            }else{
                rate = {{ $rate->rate }}
            }    
        }
         $('#rate').text(rate);
        const NPR = SENDING_AMOUNT * rate

        if(NPR < 0) {
            $('.remit_bind').val(REMIT_AMOUNT)
            $("input[name='npr']").val('')
            return
        }
        $("input[name='npr']").val(NPR.toFixed(2));
    }

  	$(document).ready(function(){
  		$("#phone").inputmask({"mask": "9999999999"});
  	});

	 $('.message').fadeOut(4000);


	 //Apply service charge

	 $('.apply__service_button').click(function() {
         $(this).remove()
         $('.service_code').removeClass('d-none')
    })

	$('.apply__service__code').click(async function() {
            const SERVICE_CODE = $("input[name='service_code_value']").val()

            if(SERVICE_CODE == '') {
                alert('Please enter Service Charge Amount')
            }else{

				$('.service_charge_message').html('').append('Service Charge Added')

            const SERVICE_AMOUNT = parseInt(SERVICE_CODE)
			const REMIT_AMOUNT = $('.remit_amount').val()
			const SENDING_AMOUNT = REMIT_AMOUNT - SERVICE_AMOUNT
            $('.sending_amount').val(SENDING_AMOUNT)

            const NPR_AFTER_SERVICE_CHARGE = SENDING_AMOUNT * rate
            if(NPR_AFTER_SERVICE_CHARGE < 0) {
                alert('NPR cannot be less than 0')
                $("input[name='npr']").val(NPR)
                return;
            }

            $("input[name='npr']").val(NPR_AFTER_SERVICE_CHARGE.toFixed(2))
			}
        })




	 //promo code


	 $('.apply__coupon_button').click(function() {
         $(this).remove()
         $('.promo_code').removeClass('d-none')
    })

	 $('.check__promo__code').click(async function() {
            const URL = "{{ route('admin.check.promocode') }}"
            const PROMO_CODE = $("input[name='promo_code_value']").val()
            const CUSTOMER_ID = $("input[name='customerid']").val()

            if(PROMO_CODE == '') {
                alert('Please enter promo code')
            }
            const {data} = await axios.post(URL, {
                promo_code: PROMO_CODE,
					 customerid: CUSTOMER_ID
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
            $("input[name='npr']").val(AMOUNT_AFTER_PROMOCODE.toFixed(2))
        })

  	$(document).ready(function(){
        $('.type').change(function(){
            var value = $(this).val();
				getValueFromType(value)
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

		  var imagesPreview = function(input, placeToInsertImagePreview) {
	      console.log(input.files);
	      console.log(placeToInsertImagePreview);
	        if (input.files) {
	            var filesAmount = input.files.length;
	            for (i = 0; i < filesAmount; i++) {
	                var reader = new FileReader();
	                reader.onload = function(event) {
	                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview).css({'width' : '150px', 'margin-right': '10px', 'margin-top': '10px'});
	                }
	                reader.readAsDataURL(input.files[i]);
	            }
	        }
	     };
	     $('#fileUpload').on('change', function() {
	        imagesPreview(this, 'div#image-holder');
	     });
   });

    $(document).ready(function(){
        $("#contact_number").inputmask({"mask": "9999999999"});
        $("#receiver_contact_number").inputmask({"mask": "9999999999"});
    })

    </script>
	 <script>
		 function getValueFromType(value) {
        	$('.selected__type').val(value)
    	 }
	 </script>
@endpush