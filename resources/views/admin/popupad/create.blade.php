@extends('layouts.admin')

@section('title', 'Add New popup')

@push('admin.styles')
@endpush

@section('content')
<section class="content-header">
  <h1>Popup<small> Create</small></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="">popupad</a></li>
    <li><a href="">Create</a></li>
  </ol>
</section>
<div class="content">
  <div class="alert alert-danger" style="display:none"></div>
  @if (count($errors) > 0)
  <div class="alert alert-danger message">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form action="{{route('popupad.store')}}" method="post" enctype="multipart/form-data" id="form">
    {{csrf_field()}}
    <div class="row">
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-heading">
            <h3 class="box-title">Add a new popupad</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label>Upload Image</label>
              <input type="file" name="image" id="image">
            </div>
            <div class="form-group">
              <label>Link</label>
              <input type="text" class="form-control" name="link">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-warning">
          <div class="box-header with-heading">
            <h3 class="box-title">Publish</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="publish"><input type="checkbox" id="publish" name="published" checked> Publish</label>
            </div>
            <div class="form-group">
              <input type="submit" value="submit" name="" class="btn btn-success">
            </div>
          </div>
        </div>
      </div>

    </div>
</div>
</form>
@endsection
@push('script')

@endpush