@extends('layouts.admin')
@section('title','Rate')
@push('admin.styles')
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- bootstrap wysihtml5 - text editor -->

@endpush
@section('content')
<section class="content-header">
	<h1>Rate<small></small></h1>

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
    <form method="post" action="{{route('changerate.store')}}" enctype="multipart/form-data">
		{{csrf_field()}}
		<div class="row">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header with-heading">
						<h3 class="box-title">Change Rate</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Todays Exchange Rate</label>
							<input type="text" name="rate" class="form-control" value="{{$composer__rate->rate}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header with-heading">
						<h3 class="box-title">Offer Price</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Todays Offer Price</label>
							<input type="text" name="offerprice" class="form-control" value="{{$composer__rate->offer_price??0}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header with-heading">
						<h3 class="box-title">Offer Change Rate</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label>Todays Offer Rate</label>
							<input type="text" name="offerrate" class="form-control" value="{{$composer__rate->offer_rate??0}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
						</div>
						
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Change Rate</button>
			</div>
			
		</div>
	</form>

</div>
@endsection
@push('script')

<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- datepicker -->
<script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>



@endpush