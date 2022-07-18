@extends('layouts.admin')
@section('title','User Detail')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
	<h1>User <small>Detail</small></h1>
	<a href="{{route('customer.index')}}" class="btn btn-success">Back</a>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Customer</a></li>
		<li><a href="">Detail</a></li>
	</ol>
</section>
<div class="content">
	@if(Session::has('message'))
	<div class="alert alert-success alert-dismissible message">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      		<span aria-hidden="true">&times;</span>
    	</button>
    	{!! Session::get('message') !!}
	</div>
	@endif
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Detail</h3>
				</div>
				<div class="box-body">
					<b>name</b> : {{$detail->name}}
					<br>
					<b>email</b>: <a href="mailto:{{$detail->email}}">{{$detail->email}}</a>
					<br>
					
					<b>phone</b>: {{$detail->phone}}
					<br>
					
					<b>CustomerId</b>: {{$detail->customerid}}
					
					<br>
					<br>
					
					<hr> 
					<u><b>address</b></u>
					<br>
					{{$detail->address}}
					<br>
					<b>suburb</b>: {{$detail->suberb}}
					<br>
					<b>state</b>: {{$detail->state}}
					<br>
					<b>post code</b>: {{$detail->post_code}}
					
					<br>
					
					<b>IDType</b>: {{$detail->idtype}}
					
					<br>
					<b>ID</b>
					<a href="{{asset('document/'.$detail->citizenship)}}" download="">Download Id</a>
					<hr>
					<div class="row">
						<div class="col-lg-4">
							<img src="{{asset('document/'.$detail->citizenship)}}" style="width:100%;">
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
  <!-- DataTables -->
  <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('backend/plugins/fastclick/fastclick.js') }}"></script>
  <script >
  	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
      $('.message').fadeOut(3000);
       $('.delete').submit(function(e){
        e.preventDefault();
        var message=confirm('Are you sure to delete');
        if(message){
          this.submit();
        }
        return;
       });
    });
  </script>
  <script>
  $(function () {
    $("#example1").DataTable();
  });

</script>
@endpush
