@extends('layouts.admin')

@section('title', 'Edit Transaction')

@push('admin.styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/datepicker/datepicker3.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')
<section class="content-header">
   <h1>Transaction<small> Edit</small></h1>
   <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
      <li><a href="">Transaction</a></li>
      <li><a href="">Edit</a></li>
   </ol>
</section>
<div class="content">
   <div class="alert alert-danger" style="display:none"></div>
   @if (count($errors) > 0)
   <div class="alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
   @endif

   <form action="{{route('transaction.update',$detail->id)}}" method="POST" enctype="multipart/form-data">
      {{csrf_field()}}

      <input type="hidden" name="_method" value="PUT">

      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header with-heading">
                  <h3 class="box-title">Edit transaction</h3>
               </div>
               <div class="box-body">
                  @if($detail->type=="Bank-Deposit")
                   <input type="hidden" name="type" value="Bank-Deposit">

                  <div class="form-group">
                     <label>Account Holder Name: <span class="text-danger">*</span></label>
                     <input type="text" name="account_holder_name" class="form-control" required
                        value="{{$detail->account_holder_name }}" />
                  </div>
                  <div class="form-group">

                     <label>Receiver Contact Number: <span class="text-danger">*</span></label>
                     <input type="text" name="contact_number" class="form-control" id="contact_number" /
                        data-inputmask="'mask': '9999999999'" value="{{ $detail->contact_number }}">
                  </div>
                  <div class="form-group">
                     <label>Bank Name: <span class="text-danger">*</span></label>
                     <input type="text" name="bank_name" value="{{ $detail->bank_name }}" class="form-control"
                        required="" value="N\A" />
                  </div>
                  <div class="form-group">
                     <label>Bank Branch: <span class="text-danger">*</span></label>
                     <input type="text" name="bank_branch" class="form-control" value="{{ $detail->bank_branch }}" />
                  </div>
                  <div class="form-group">
                     <label>Account Number: <span class="text-danger">*</span></label>
                     <input type="text" name="account_number" class="form-control"
                        value="{{ $detail->account_number }}" />
                     <small>please double check</small>
                  </div>
                  @else
                  {{-- remit --}}
                  <input type="hidden" name="type" value="Remit">

                  <div class="form-group">
                     <label>Full Name: <span class="text-danger">*</span></label>
                     <input type="text" name="full_name" class="form-control" value="{{ $detail->full_name }}" />
                  </div>
                  <div class="form-group">
                     <label>Receiver Contact Number: <span class="text-danger">*</span></label>
                     <input type="text" name="receiver_contact_number" class="form-control" required/
                        id="receiver_contact_number" data-inputmask="'mask': '9999999999'"
                        value="{{ $detail->receiver_contact_number }}">
                  </div>
                  <div class="form-group">
                     <label>Pick up District: <span class="text-danger">*</span></label>
                     <input type="text" name="pick_up_district" class="form-control"
                        value="{{ $detail->pick_up_district }}" />
                     <small>current address</small>
                  </div>
                  @endif
                  <div id="transactionEdit">
                     <div class="form-group">
                        <label>Rate</span></label>
                        <input type="text" name="rate" v-model="rate" class="form-control" />
                     </div>
                     <div class="form-group">
                        <label>REMIT AMOUNT $:<span class="text-danger">*</span></label>
                        <input type="number" name="remit_amount" class="form-control remit_amount" step="any"
                           v-model="remit_amount" />
                        <small>including $10 service charge.</small>
                     </div>
                     <div class="form-group">
                        <label>NPR: <span class="text-danger">*</span></label>
                        <input type="text" name="npr" class="form-control npr" readonly="" value="{{ $detail->npr }}"
                           :value="calculateNpr" />
                     </div>
                  </div>
                  {{-- @if($detail->status!=2)
                  <div class="form-group">
                     @if($detail->status!=1)
                     <input type="radio" name="status" value="1" {{$detail->status==1?'checked':''}}> In
                  Progress<br>
                  @endif
                  <input type="radio" name="status" value="2" {{$detail->status==2?'checked':''}}>
                  Delivered<br>
               </div>
               @else
               <b>sent</b>
               @endif --}}
               @if($detail->status != 2)
               <input type="radio" name="status" value="1" {{$detail->status==1?'checked':''}}> In
               Progress<br>
               <input type="radio" name="status" value="2" {{$detail->status==2?'checked':''}}>
               Delivered<br>
               @elseif($detail->status==2)
               <input type="radio" name="status" value="0" {{$detail->status==0?'checked':''}}> Pending<br>
               <input type="radio" name="status" value="1" {{$detail->status==1?'checked':''}}>
               In progress<br>
               @endif
               <div style="margin-top: 6px;" class="form-group">
                  <input type="submit" value="submit" name="" class="btn btn-success">
               </div>
            </div>
         </div>
      </div>
</div>
</form>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript"
   src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>
<script>
   $(document).ready(function() {
		$("#contact_number").inputmask({
			"mask": "9999999999"
		});
		$("#receiver_contact_number").inputmask({
			"mask": "9999999999"
		});
	});
</script>
<script>
   const default_rate = "{{ $detail->rate }}";
   const default_remit_amount = "{{ $detail->remit_amount }}";
   var app = new Vue({
      'el': '#transactionEdit',
      data() {
         return {
            rate: default_rate,
            remit_amount: default_remit_amount
         }
      },
      computed: {
         calculateNpr() {
            const npr = parseFloat(this.rate) * parseFloat(this.remit_amount-10);
            return npr.toFixed(2);
         }
      }
   });
</script>
@endpush