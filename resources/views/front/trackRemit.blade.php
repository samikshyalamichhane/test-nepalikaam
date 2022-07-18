@extends('layouts.front')
@section('content')
<div class="container">
		@if(Session::has('message'))
		<div class="alert alert-success alert-dismissible message">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	      		<span aria-hidden="true">&times;</span>
	    	</button>
	    	{!! Session::get('message') !!}
		</div>
		@endif
	<form action="{{route('searchRemit')}}" method="post">
		{{csrf_field()}}
		<div class="form-group">
		<input type="text" name="token" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="submit" class="btn btn-success">
		</div>
	</form>
</div>
@endsection