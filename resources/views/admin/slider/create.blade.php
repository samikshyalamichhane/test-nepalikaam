@extends('layouts.admin')

@section('title', 'Add New Slider')

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
	<h1>Slider<small> Create</small></h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="">Slider</a></li>
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
<form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data" id="form">
{{csrf_field()}}
<div class="row">
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header with-heading">
				<h3 class="box-title">Add a new slider</h3>
			</div>
			<div class="box-body">
				 <div class="form-group">
                      <label>Upload Image</label>
                      <input type="file" name="filename" id="image">
                 </div>
                 <div class="form-group" id="wrapper">
                      <div id="image-holder">
                      <img src="" class="thumb-image img-responsive" > 
                      <input type="hidden" name="image"  id="name">
                      </div>
                 </div>
                 <div class="form-group">
                     <button value="crop" type="button" id="crop" class="btn btn-success hidden">crop</button>
                </div>
                <div class="form-group">
                  <label>Title(required)</label>
                  <input type="text" name="title" class="form-control" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label>Sub Title</label>
                    <input type="text" name="sub_title" value="{{old('sub_title')}}" class="form-control">
                </div>
                
                 
			</div>
		</div>
	</div>
	@include('admin.include.modal')
	<div class="col-md-4">
		<div class="box box-warning">
			<div class="box-header with-heading">
				<h3 class="box-title">Publish</h3>
			</div>
			<div class="box-body">
				<div class="form-group">
						<label for="publish"><input type="checkbox" id="publish" name="publish"  checked> Publish</label>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- CK Editor -->
  <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
  <!-- datepicker -->
 <script src="{{asset('js/jquery.Jcrop.min.js')}}"></script>
 <script>
 $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });
 /****image upload****/
 var _URL = window.URL || window.webkitURL;
     var _URL = window.URL || window.webkitURL;
     $(document).ready(function(){
       $('#image').change(function(){
        $('#crop').removeClass('hidden');
         var file,img;
         if ((file = this.files[0])) {
            img = new Image();
            img.onload = function() {
            var width=this.width;
            var height=this.height;
            if(height<400 || width<800)
            {
             alert('you must upload image more than 800*400');
            }
            else
            {
           var formData = new FormData($('#form')[0]);
           $.ajax
             ({
               url: "{{route('sliderProcess')}}",
               method: 'POST',
               data: formData,
               async: false,
               cache: false,
               contentType: false,  
               processData: false,
               success: function (data)
                      {
                        jQuery.each(data.errors, function(key, value){
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append('<p>'+value+'</p>');
                        });
                        if(data['success']=='success'){
                            console.log(data);
                         $(".thumb-image").attr('src',data['path']+'/'+data['name']);
                         $(document).find('#crop').attr('data-image',data['name']);
                         $("#name").val(data['name']);
                        }
                      }, 
              error : function(status){
                console.log(status);
              }
             });
            }
            };
            img.onerror = function() {
             alert( "not a valid file: " + file.type);
             };
             img.src = _URL.createObjectURL(file);
             }
       });
       });
   
   $(document).ready(function(){
     $(document).on("click","#crop",function(){
        var name= $("#name").val();
       $.ajax({
         url:"{{route('cropmodal')}}",
         data:{name:name},
         method:"post",
         success:function(data){
            $('#myModal .modal-body').html(data);
            $('#myModal').modal('show');
         }
       });
     });
   });
   $('.message').delay(5000).fadeOut(400);
 </script>
@endpush