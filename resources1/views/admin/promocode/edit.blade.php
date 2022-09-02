@extends('layouts.admin')
@section('title','Edit promocode')
@push('admin.styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')
<section class="content-header">
	<h1>Promocode<small>create</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Promocode</a></li>
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
	@if (session('message'))
	<div class="alert alert-success message">
		<span>
			{{ session('message') }}
		</span>
	</div>
	@endif
<form method="post" action="{{route('promocode.update', $detail->id)}}" enctype="multipart/form-data">
	{{csrf_field()}}
	@method('PUT')
	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-heading">
					<h3 class="box-title">Edit promocode</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Promo code</label>
						<input type="text" name="promo_code" class="form-control" value="{{$detail->promo_code}}">
					</div>

					<div class="form-group">
						<label>Discounted Amount in $</label>
						<input type="text" name="discounted_amount" class="form-control" value="{{$detail->discounted_amount}}">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-warning">
				<div class="box-body">

					<div class="form-group">
						<label>Users</label>
						<select name="users[]" multiple="multiple" id="multiple-select-vendor"
							 class="js-example-basic-multiple form-control">
							 <option value>--Please select--</option>
							 @foreach ($users as $user)
								  <option value="{{ $user->id }}">{{ $user->name }}</option>
							 @endforeach
						</select>
				   </div>
					<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish"  {{ $detail->publish == 1 ? 'checked' : null }}> Publish</label>
					</div>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script>
      $("#multiple-select-vendor").select2().val({!! json_encode($detail->users()->pluck('user_id')) !!}).trigger('change');
		$('.message').fadeOut(1000)
	</script>
@endpush