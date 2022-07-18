@extends('layouts.admin')
@section('title','Dashboard')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- bootstrap wysihtml5 - text editor -->

@endpush
@section('content')
<section class="content-header">
	<h1>Dashboard<small></small></h1>

</section>
<div class="content">
@if(session('message'))
<div class="alert alert-info alert-dismissible" id="successMessage">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session('message')}}
</div>
@endif
	@if (count($errors) > 0)
	  <div class="alert alert-danger message">
	      <ul>
	          @foreach($errors->all() as $error)
	          <li>{{$error}}</li>
	          @endforeach
	      </ul>
	  </div>
  @endif
	<form method="post" action="{{route('dashboard.update',$detail->id)}}" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="hidden" name="_method" value="PUT">
		<div class="row">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header with-heading">
						<h3 class="box-title">Contacts</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Address</label>
							<input type="text" name="address" class="form-control" value="{{$detail->address}}">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="phone" class="form-control" value="{{$detail->phone}}">
						</div>
						<div id="app">
							<label>Password to check rate</label>
							<div class="input-group form-group">
								<input value="{{ $detail->password }}" type="password" :type="toggleShowPassword"
									name="password" class="form-control">
								<span @click="viewPassword" class="input-group-addon" {{--
									@mousedown="viewPassword"
									@mouseup="hidePassword" --}}>
									<i :class="['fa',`fa-eye${isShow ? '-slash' : '' }`]"></i>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" class="form-control" value="{{$detail->email}}">
						</div>

						<div class="form-group">
							<label>Service Charge in $</label>
							<input type="text" name="service_charge" class="form-control" value="{{$detail->service_charge}}"  placeholder="Enter Service Charge $">
						</div>

						<div class="form-group">
							<label>Transaction limit bank deposit in $</label>
							<input type="text" name="transaction_limit_bank_deposit" class="form-control" value="{{$detail->transaction_limit_bank_deposit}}"  placeholder="Enter transaction limit $">
						</div>
						<div class="form-group">
							<label>Transaction limit remit in $</label>
							<input type="text" name="transaction_limit_remit" class="form-control" value="{{$detail->transaction_limit_remit}}"  placeholder="Enter transaction limit $">
						</div>
						<div class="form-group">
							<label>Transaction limit esewa in $</label>
							<input type="text" name="transaction_limit_esewa" class="form-control" value="{{$detail->transaction_limit_esewa}}"  placeholder="Enter transaction limit $">
						</div>

						<div class="form-group">
							<label>Google Map</label>
							<textarea name="map" class="form-control" rows="3">{{$detail->map}}</textarea>

						</div>
						<div class="form-group">
							<label>Advertisement</label>
							<textarea class="form-control" rows="3" name="advertisement">{{$detail->advertisement}}</textarea>
						</div>
						<div class="form-group">
							<label>Mission</label>
							<textarea class="form-control" rows="3" name="mission">{{$detail->mission}}</textarea>
						</div>
						<div class="form-group">
							<label>Notice</label>
							<textarea class="form-control" rows="3" name="notice">{!!$detail->notice!!}</textarea>
						</div>
							<div class="form-group">
							<label>News Feed</label>
							<textarea class="form-control" rows="3" name="news_feed">{!!$detail->news_feed!!}</textarea>
						</div>
						<div class="form-group">
							<label>Bank Details</label>
							<textarea class="form-control" rows="3"
								name="bank__details">{!!$detail->bank__details!!}</textarea>
						</div>
						<div class="form-group">
							<label>New Bank Details(Only If You change Bank Details)/(optional)<br><span class="alert-warning">
                              *Remembar: This will allow to display notification on client dashboard.'
                           </span></label>
							<textarea class="form-control" rows="3"
								name="notification">{!!$detail->notification!!}</textarea>
						</div>
					</div>
				</div>
		</div>
		<div class="col-md-4">

			{{-- New Registration Email to Customer --}}
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">New Registration Email to Customer</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Email to Customer</label>
						<textarea class="form-control" rows="3"
							name="registerTemplate">{!!$detail->registerTemplate!!}</textarea>
					</div>
				</div>
			</div>

			{{-- Transaction Email to Customer --}}
			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Transaction Email to Customer</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Transaction subject</label>
						<input type="text" name="newTransactionSubject" class="form-control"
							value="{{$detail->newTransactionSubject}}">
					</div>
					<div class="form-group">
						<label>Transaction Email</label>
						<textarea class="form-control" rows="3"
							name="transactionTemplate">{!!$detail->transactionTemplate!!}</textarea>
					</div>
				</div>
			</div>

			<div class="box box-warning">
				<div class="box-header with-heading">
					<h3 class="box-title">Social Network</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Facebook Link</label>
						<input type="text" name="facebook" class="form-control" value="{{$detail->facebook}}">
					</div>
					<div class="form-group">
						<label>Twitter Link</label>
						<input type="text" name="twitter" class="form-control" value="{{$detail->twitter}}">
					</div>
					<div class="form-group">
						<label>Whats App</label>
						<input type="text" name="whatsapp" class="form-control" value="{{$detail->whatsapp}}">
					</div>
					<!-- <div class="form-group">
						<label>Youtube Link</label>
						<input type="text" name="youtube" class="form-control" value="{{$detail->youtube}}">
					</div> -->
					<div class="form-group">
						<label>Instagram Link</label>
						<input type="text" name="instagram" class="form-control" value="{{$detail->instagram}}">
					</div>
					<!-- <div class="form-group">
						<label>Linkedin Link</label>
						<input type="text" name="linkedin" class="form-control" value="{{$detail->linkedin}}">
					</div> -->
					<div class="form-group">
						<input type="submit" name="" class="btn btn-success">
					</div>
				</div>
			</div>
		</div>

</div>
</form>

</div>
@endsection
@push('script')

<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<!-- production version, optimized for size and speed -->
{{-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}

<script>
	var app = new Vue({
		el: '#app',
		data: {
			type: 'password',
			isShow: false
		},
		methods: {
			viewPassword() {
				return this.isShow = !this.isShow
			},
			// hidePassword() {
			// 	return this.isShow = false
			// }
		},
		computed: {
			toggleShowPassword() {
				return this.isShow ? 'text' : 'password'
			}
		}
	});


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- datepicker -->
<script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- CK Editor -->
<script src="//cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<!-- datepicker -->
<script>
	CKEDITOR.replace('notice');
	CKEDITOR.config.removeButtons = 'Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Redo,Undo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,NumberedList,Outdent,Indent,Blockquote,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Link,Unlink,Anchor,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,TextColor,BGColor,Maximize,ShowBlocks,About';

	CKEDITOR.replace('bank__details');
    CKEDITOR.replace('notification');
	CKEDITOR.replace('news_feed');

	CKEDITOR.replace('registerTemplate');
	CKEDITOR.replace('transactionTemplate');

   CKEDITOR.config.height = 200;

    $(document).ready(function () {

    		$("#fileUpload").on('change', function () {

    	      if (typeof (FileReader) != "undefined") {

    	          var image_holder = $("#image-holder");
    	          image_holder.empty();

    	          var reader = new FileReader();
    	          reader.onload = function (e) {
    	              $("<img />", {
    	                  "src": e.target.result,
    	                  "class": "thumb-image",
    	                  "width" : '50%'
    	              }).appendTo(image_holder);

    	          }
    	          image_holder.show();
    	          reader.readAsDataURL($(this)[0].files[0]);
    	      } else {
    	          alert("This browser does not support FileReader.");
    	      }
    	  });

     });

</script>
<script type="text/javascript">
	$(' #cash_filler').keypress(function(event){
       if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
           event.preventDefault();
       }
   });

</script>

@endpush