@extends('layouts.admin')
@section('title','Transaction Detail')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
	<h1>Transaction<small>List</small></h1>
	<a href="{{route('transaction.index')}}" class="btn btn-success">Back</a>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Transaction</a></li>
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

				<div class="box-body table-responsive  ">
					Type: {{$detail->type}}
					<br>

					Sender Name: {{$detail->user->name}}
					<br>
					Customer ID: {{$detail->user->customerid}}
					<br>
					Email: <a href="mailto:{{$detail->user->email}}">{{$detail->user->email}}</a>
					<br>
					Phone: {{$detail->user->phone}}
					<br>
					<hr>
					<u>Receiver Detail</u>
					<br>
					@if($detail->type=='Bank-Deposit')

					Account Holder Name:{{$detail->account_holder_name}}

					<br>
					Receiver Contact No:{{$detail->contact_number}}
					<br>
					Bank Name:{{$detail->bank_name}}
					<br>
					Bank Branch:{{$detail->bank_branch}}
					<br>
					Account Number:{{$detail->account_number}}
					<br>


					@else
					Full Name:{{$detail->full_name}}
					<br>
					Receicver Contact No:{{$detail->receiver_contact_number}}
					<br>
					Pick Up District:{{$detail->pick_up_district}}

					@endif
					Remit Amount:{{$detail->remit_amount}}
					<br>
					NPR::{{$detail->npr}}
					<br>
					Code:{{$detail->random_token}}
					<br>
					<hr>
					@if($detail->transfer_receipt)
					<u>Transaction Bill</u><br>

					<img src="{{asset('images/main/'.$detail->transfer_receipt)}}">
					@endif
					<hr>
					<br>
					@if($detail->status!=2)
					<form method="post" action="{{route('transaction.update',$detail->id)}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">
						<div class="form-group">
							@if($detail->status!=1)
							<input type="radio" name="status" value="1" {{$detail->status==1?'checked':''}}> In Progress<br>
							@endif
							<input type="radio" name="status" value="2" {{$detail->status==2?'checked':''}}> Delivered<br>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="change Status" class="bt  btn-success form-control">
						</div>
					</form>
					@else
					<b>sent</b>
					@endif

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
<script>
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