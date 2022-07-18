@extends('layouts.admin')
@section('title','Rejected List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
  <h1>Rejected<small>List</small></h1>
  
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="">Rejected</a></li>
    <li><a href="">list</a></li>
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
          <h3 class="box-title">Data Table</h3>
        </div>
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Customer Id</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @php($i=1)
                        @foreach($details as $detail)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>{{$detail->name}}</td>
                          <td>{{$detail->customerid}}</td>
                    <td>{{$detail->email}}</td>
                    <td><a href="{{route('approveCustomer',$detail->id)}}" class="btn btn-info">Approve</a>
                    </td>
                        </tr>
                        @php($i++)
                        @endforeach
            </tbody>
          </table>
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
  $(document).ready(function(){
    $('.change-status').on('click',function(){
    var _this = this;
    var status=$(_this).data('val');
    
     var id=$(_this).parent().data('fid');
    $.ajax({
      method: "POST",
      url:"{{route('changeStatus')}}",
      data: {status:status,id:id},
      success:function(res){
        console.log(res);
        $(_this).addClass('active');
        $(_this).siblings().removeClass('active');
      }

  });
  });
  });

</script>
@endpush
