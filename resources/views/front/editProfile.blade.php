@extends('front.userdashboard')

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
        <div class="profile_form">
            <h2>Edit Your Profile Here</h2>
            <form action="{{route('updateProfile',$data->id)}}" method="post" enctype="multipart/form-data" class="row">
                {{csrf_field()}}
                <div class="form-group col-lg-6 col-md-12 col-12">
                    <label for="name">Phone</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="phone"
                        value="{{$data->phone}}">
                </div>
                <div class="form-group col-lg-6 col-md-12 col-12">
                    <label>Unit Number/Street Name and Number</label>
                    <input type="text" name="address" class="form-control" value="{{$data->address}}">
                </div>
                <div class="form-group col-lg-6 col-md-12 col-12">
                    <label>Suburb</label>
                    <input type="text" name="suberb" class="form-control" value="{{$data->suberb}}">
                </div>
                <div class="form-group col-lg-6 col-md-12 col-12">
                    <label>State</label>
                    <input type="text" name="state" class="form-control" value="{{$data->state}}">
                </div>
                <div class="form-group col-lg-6 col-md-12 col-12">
                    <label>Post Code</label>
                    <input type="text" name="post_code" class="form-control" value="{{$data->post_code}}">
                </div>
                <div class="col-12">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection