@extends('front.userdashboard')

@section('content')

<div class="container">
   <div class="row">
      <div class="col-12 col-sm-6">
         <!--<div class="table-wrapper">-->
             <div class="box box-primary">
            <div class="box-body box-profile">
             <h3 class="py-3">My Profile</h3>
              <img class="profile-user-img img-responsive img-circle" src="/front/img/user.png" alt="User profile picture">

              <h3 class="profile-username text-center">{{$data->name}}</h3>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <p class="pull-right">{{$data->email}}</p>
                </li>
                <li class="list-group-item">
                  <b>Client Id</b> <p class="pull-right">{{$data->customerid}}</p>
                </li>
                <li class="list-group-item">
                  <b>Phone :</b> <p class="pull-right">{{$data->phone}}</p>
                </li>
                <li class="list-group-item">
                  <b>Address :</b> <p class="pull-right">{{$data->address}}</p>
                </li>
                <li class="list-group-item">
                  <b>Suberb :</b> <p class="pull-right">{{$data->suberb}}</p>
                </li>
                <li class="list-group-item"><b>State :</b>
                  <p class="pull-right">{{$data->state}}</p>
               </li>
               <li class="list-group-item"><b>Post Code :</b>
                  <p class="pull-right" >{{$data->post_code}}</p>
               </li>
              </ul>

              <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
            </div>
            <!-- /.box-body -->
          </div>
            <!--<h3 class="py-3">View Your Profile</h3>-->
            <!--<ul class="personal-info">-->
            <!--   <li><span>Name :</span>-->
            <!--      <p>{{$data->name}}</p>-->
            <!--   </li>-->
            <!--   <li><span>Email :</span>-->
            <!--      <p>{{$data->email}}</p>-->
            <!--   </li>-->
            <!--   <li><span>Client Id :</span>-->
            <!--      <p>{{$data->customerid}}</p>-->
            <!--   </li>-->
            <!--   <li><span>Phone :</span>-->
            <!--      <p>{{$data->phone}}</p>-->
            <!--   </li>-->
            <!--   <li><span>Address :</span>-->
            <!--      <p>{{$data->address}}</p>-->
            <!--   </li>-->
            <!--   <li><span>Suberb :</span>-->
            <!--      <p>{{$data->suberb}}</p>-->
            <!--   </li>-->
            <!--   <li><span>State :</span>-->
            <!--      <p>{{$data->state}}</p>-->
            <!--   </li>-->
            <!--   <li><span>Post Code :</span>-->
            <!--      <p>{{$data->post_code}}</p>-->
            <!--   </li>-->
            <!--</ul>-->

         <!--</div>-->
      </div>
   </div>
</div>

{{-- <section class="edit-section">
   <div class="container">
      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible message">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         {!! Session::get('message') !!}
      </div>
      @endif
      <div class="profile_form">
         <h2>View Your Profile Here</h2>
         <form method="post" enctype="multipart/form-data" class="row">
            {{csrf_field()}}
<div class="form-group col-lg-6 col-md-12 col-12">
   <label for="name">Name</label>
   <input type="text" disabled class="form-control" id="name" placeholder="Enter name" name="phone"
      value="{{$data->name}}">
</div>
<div class="form-group col-lg-6 col-md-12 col-12">
   <label for="name">Email</label>
   <input type="text" disabled class="form-control" id="name" placeholder="Enter name" name="phone"
      value="{{$data->email}}">
</div>
<div class="form-group col-lg-6 col-md-12 col-12">
   <label for="name">Client Id</label>
   <input type="text" disabled class="form-control" id="name" placeholder="Enter name" name="phone"
      value="{{$data->customerid}}">
</div>
<div class="form-group col-lg-6 col-md-12 col-12">
   <label for="name">Phone</label>
   <input type="text" disabled class="form-control" id="name" placeholder="Enter name" name="phone"
      value="{{$data->phone}}">
</div>
<div class="form-group col-lg-6 col-md-12 col-12">
   <label>Unit Number/Street Name and Number</label>
   <input type="text" disabled name="address" class="form-control" value="{{$data->address}}">
</div>
<div class="form-group col-lg-6 col-md-12 col-12">
   <label>Suburb</label>
   <input type="text" disabled name="suberb" class="form-control" value="{{$data->suberb}}">
</div>
<div class="form-group col-lg-6 col-md-12 col-12">
   <label>State</label>
   <input type="text" disabled name="state" class="form-control" value="{{$data->state}}">
</div>
<div class="form-group col-lg-6 col-md-12 col-12">
   <label>Post Code</label>
   <input type="text" disabled name="post_code" class="form-control" value="{{$data->post_code}}">
</div>
<div class="col-12">
   <button type="submit">Update</button>
</div>
</form>
</div>
</div>
</section> --}}

@endsection