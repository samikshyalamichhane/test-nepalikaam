@extends('layouts.admin')

@section('title', 'Edit popupad')

@push('admin.styles')
@endpush

@section('content')
<section class="content-header">
  <h1>Popup Ad<small> Edit</small></h1>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="">popupad</a></li>
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
  <form action="{{route('popupad.update',$detail->id)}}" method="post" enctype="multipart/form-data" id="form">
    {{csrf_field()}}
    @method('PUT')
    <div class="row">
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-heading">
            <h3 class="box-title">Edit popupad</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label>Upload Image</label>
              <input type="file" name="image" id="image" onchange="loadFile(event)">
              @if($detail->image)
              <img class="output" style="max-width: 100%; margin-top: 10px;" src="/images/main/{{ $detail->image}}"
                alt="image">
              @endif
            </div>
            <div class="form-group">
              <label>Link</label>
              <input type="text" class="form-control" name="link" value="{{ $detail->link }}">
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
              <label for="publish"><input type="checkbox" id="publish" name="published"
                  {{$detail->published ? 'checked': ''}}> Publish</label>
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
<script>
  function loadFile(event) {
      var reader = new FileReader();
      reader.onload = function(){
        var output = document.querySelector('.output');
        output.src = reader.result;
        console.log(output.src);
      };
      reader.readAsDataURL(event.target.files[0]);
};
</script>
@endpush