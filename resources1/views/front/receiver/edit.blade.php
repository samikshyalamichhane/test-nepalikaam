@extends('front.userdashboard')

@push('styles')
@endpush

@section('content')


<section class="edit-section">
   <div class="container">
      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible message">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         {!! Session::get('message') !!}
      </div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
         <ul>
            @foreach ($errors->all() as $error)
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <div class="profile_form">
         <h2>Edit Receiver info</h2>
         @if($data->type=='Remit' && !isset($data->receiver__id))
         <p class="text-danger"> *Click Update button to get receiver phone number</p>
         @endif

         <form method="post" enctype="multipart/form-data" class="row" @if(isset($data->receiver__id))
            action="{{route('updateReceiver', $data->receiver__id)}}"
            @elseif($data->type=='Bank-Deposit')
            action="{{route('updateReceiver', $data->account_number)}}"
            @else
            action="{{route('updateReceiver', $data->receiver_contact_number)}}"
            @endif
            >
            {{csrf_field()}}
            @method('PUT')
            <input type="hidden" name="type" value="{{ $data->type }}">
            <input type="hidden" name="receiver__id" value="{{ $data->receiver__id }}">
            @if($data->type == 'Bank-Deposit')
            <input type="hidden" name="account_number" class="form-control" value="{{$data->account_number}}">
            <div class="form-group col-lg-6 col-md-12 col-12">
               <label>Account Holder Name</label>
               <input type="text" class="form-control" id="name" placeholder="Enter name" name="account_holder_name"
                  value="{{ $data->account_holder_name}}">
            </div>

            <div class="form-group col-lg-6 col-md-12 col-12">
               <label>Bank name</label>
               <input type="text" name="bank_name" class="form-control" value="{{$data->bank_name}}">
            </div>
            <div class="form-group col-lg-6 col-md-12 col-12">
               <label>Bank branch</label>
               <input type="text" name="bank_branch" class="form-control" value="{{$data->bank_branch}}">
            </div>
            <div class="form-group col-lg-6 col-md-12 col-12">
               <label>Contact Number</label>
               <input name="contact_number" class="form-control contact_number" type="number"
                  value="{{$data->contact_number}}" pattern="/^-?\d+\.?\d*$/"
                  onKeyPress="if(this.value.length==10) return false">
            </div>
            @else
            <input type="hidden" name="receiver_contact_number" class="form-control"
               value="{{$data->receiver_contact_number}}">
            <div class="form-group col-lg-6 col-md-12 col-12">
               <label for="name">Fullname</label>
               <input type="text" class="form-control" id="name" placeholder="Enter name" name="full_name"
                  value="{{ $data->full_name}}">

            </div>
            <div class="form-group col-lg-6 col-md-12 col-12">
               <label>Pick up district</label>
               <input type="text" name="pick_up_district" class="form-control" value="{{$data->pick_up_district}}">
            </div>
            @if(isset($data->receiver__id))
            <div class="form-group col-lg-6 col-md-12 col-12">
               <label>Receiver Contact Number</label>

               <input name="receiver_contact_number" class="form-control contact_number" type="number"
                  value="{{$data->receiver_contact_number}}" pattern="/^-?\d+\.?\d*$/"
                  onKeyPress="if(this.value.length==10) return false">
            </div>
            @endif
            @endif
            <div class="col-12">
               <button type="submit">Update</button>
            </div>
         </form>
      </div>
   </div>
</section>

@endsection