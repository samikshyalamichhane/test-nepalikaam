@extends('layouts.admin')
@section('title','Edit Customer')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
<!-- bootstrap wysihtml5 - text editor -->
@endpush
@section('content')
<section class="content-header">
	<h1>Customer<small>edit</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Customer</a></li>
		<li><a href="">Edit</a></li>
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
	<form method="post" action="{{route('customer.update',$detail->id)}}" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="hidden" name="_method" value="PUT">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-heading">
						<h3 class="box-title">Edit customer</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Name(required)</label>
							<input type="text" name="name" class="form-control" value="{{$detail->name}}">
						</div>
						<div class="form-group">
							<label>Email(required)</label>
							<input type="email" name="email" class="form-control" value="{{$detail->email}}">
						</div>
						<div class="form-group">
							<label>CustomerId</label>
							<input type="number" name="customerid" class="form-control" value="{{$detail->customerid}}">
						</div>
						<div class="wrap-input100 validate-input form-group">
							<span class="label-input100">ID Type</span>
							<input type="radio" name="idtype" value="Passport" {{$detail->idtype=='Passport'?'checked':''}}>
							Passport
							<input type="radio" name="idtype" value="PhotoID" {{$detail->idtype=='PhotoID'?'checked':''}}>
							PhotoID
							<input type="radio" name="idtype" value="Australian Driving Licence"
								{{$detail->idtype=='Australian Driving Licence'?'checked':''}}> Australian Driving Licence
							<span class="focus-input100"></span>
						</div>
						<div class="form-group">
							<label>Upload ID</label>
							<input type="file" name="citizenship" class="form-control">
							<img src="{{asset('document')}}/{{$detail->citizenship}}" class="thumb-image" width="150"
								height="150">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="phone" class="form-control" value="{{$detail->phone}}"
								data-inputmask="'mask': '9999999999'" id="phone">
						</div>
						<!-- <div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control" value="{{old('address')}}">
					</div> -->
						<div class="form-group">
							<label>Unit Number/Street Name and Number</label>
							<input type="text" name="address" class="form-control" value="{{$detail->address}}">
						</div>
						<div class="form-group">
							<label>Suburb</label>
							<input type="text" name="suberb" class="form-control" value="{{$detail->suberb}}">
						</div>
						<div class="form-group">
							<label>State</label>
							<input type="text" name="state" class="form-control" value="{{$detail->state}}">
						</div>
						<div class="form-group">
							<label>Post Code</label>
							<input type="text" name="post_code" class="form-control" value="{{$detail->post_code}}">
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" name="password_confirmation" class="form-control">
						</div>
					{{-- <div class="form-group">
							<label for="submit__transaction">
								<input type="checkbox" id="submit__transaction" name="submit__transaction"
									{{ $detail->submit__transaction ? 'checked' : ''}}> Enable
								Submit button
							</label>
						</div> --}}
						<div class="form-group">
							<input type="submit" name="submit" value="submit" class="btn btn-success">
						</div>

					</div>
				</div>
			</div>

		</div>
	</form>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
<script type="text/javascript"
	src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<!-- datepicker -->
<script>
	$(document).ready(function(){
  		$("#phone").inputmask({"mask": "9999999999"});
  	});

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



  	$('.message').fadeOut(400);

</script>
@endpush