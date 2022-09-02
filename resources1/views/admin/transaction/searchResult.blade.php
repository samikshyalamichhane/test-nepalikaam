@extends('layouts.admin')
@section('title','Transaction List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endpush
@section('content')
<section class="content-header">
  <h1 style="margin-bottom: 12px">Transaction<small>List</small></h1>
  <div>
    {{-- <form method="post" action="{{route('dashboard.update',$dashboard_composer->id)}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="PUT">
      <div class="form-group">
        <label for="submit__transaction">
          <input type="checkbox" id="submit__transaction" name="submit__transaction"
          {{ $dashboard_composer->submit__transaction ? 'checked' : ''}}>
          Enable transaction
        </label>
      </div>
      <button class="btn btn-success">Update</button>
    </form> --}}
  </div>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="">Transaction</a></li>
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
      <a href="{{route('transaction.index')}}" class="btn btn-primary">Go back</a>
      <div class="box">
      </div>
      <div class="box-header">
        <h3 class="box-title">Data Table</h3>

      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="box box-info newsletter hidden">
              <div class="box-header with-heading">
                <h3 class="box-title">Change Status</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Select Status</label>
                  <select name="subscriber_id" class="form-control subscriberClass">
                    <option value="1">In Progress</option>
                    <option value="2">Delivered</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="submit" name="add" value="add" class="changestatus btn btn-success">
                </div>

              </div>
            </div>
          </div>
        </div>
        {{-- <table id="example1" class="table table-bordered table-striped"> --}}
          <div class="here">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>

                  <th>S.N.</th>
                  <th>Date</th>
                  <th>Received Date</th>
                  <th>Sender Name</th>
                  <th>Customer ID</th>
                  <th>Receiver Name</th>


                  <th>Amount($)</th>
                  <th>Rate</th>
                  <th>NPR</th>

                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php($i=1)
                @foreach($details as $detail)
                <tr>

                  <td>{{$i}}</td>
                  <td>{{Carbon\Carbon::parse($detail->created_at)->format('j, M Y ') }}</td>
                  <td>
                    @if($detail->status == 2)
                    {{ Carbon\Carbon::parse($detail->updated_at)->format('j, M Y ')}}
                    @else N/A
                  @endif</td>
                  <td>{{$detail->user->name}}</td>
                  <td>{{$detail->user->customerid}}</td>
                  <td>@if($detail->type=='Bank-Deposit')
                    {{$detail->account_holder_name}}
                    @else
                    {{$detail->full_name}}
                    @endif
                  </td>
                  <td>{{$detail->remit_amount}}</td>
                  <td>{{$detail->rate}}</td>
                  <td>{{$detail->npr}}</td>

                  <td>@if($detail->status==0)
                    Pending
                    <input type="checkbox" name="singleCheck" class="sub_chk1" data-id="{{$detail->id}}">
                    @elseif($detail->status==1)
                    In Progress
                    <input type="checkbox" name="singleCheck" class="sub_chk1" data-id="{{$detail->id}}">
                    @else
                    Delivered
                    @endif
                    <td>
                      <a style="margin-bottom: 6px;" class="btn btn-info edit"
                      href="{{route('transaction.edit',$detail->id)}}" title="Edit">Edit</a>
                      <a style="margin-bottom: 6px;" class="btn btn-info edit"
                      href="{{route('transaction.show',$detail->id)}}" title="Edit">View</a>

                      <form method="post" action="{{route('transaction.destroy',$detail->id)}}" class="delete">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button style="margin-bottom: 6px;" type="submit" class="btn  btn-danger btn-delete"
                        style="display:inline">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @php($i++)
                  @endforeach
                </tbody>
              </table>
            </div>
            {{$details->links()}}
              {{-- <div class="form-group" style="margin-top: 6px;">
                <label>Select By date </label>
                <select name="getByDate" class="form-control getByDate">
                  <option value>Select date</option>
                  @foreach($details as $detail)
                  <option value="{{ \Carbon\Carbon::parse($detail->created_at)->format('Y-m-d') }}">{{\Carbon\Carbon::parse($detail->created_at)->format('d, M Y')}}</option>
                  @endforeach
                </select>
              </div>  --}}
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
        $("#example1").DataTable({
          "pageLength": 50
        });
      });


      $('#master1').change(function(){
        $('.sub_chk1').prop("checked",$(this).prop("checked"));
        $('.newsletter').removeClass('hidden');
      });

      $('.sub_chk1').change(function(){
        if($(this).is(':checked')){
          $('.newsletter').removeClass('hidden');
        }else{
          var checked = document.querySelectorAll('.sub_chk1:checked');
          if(checked.length === 0){
            $('.newsletter').addClass('hidden');
          }
        }
      });

      $(document).ready(function(){
        $('.changestatus').click(function(e){
          e.preventDefault();
          status=$('.subscriberClass').val();
          if(status){
            var allVals = [];
            $(".sub_chk1:checked").each(function() {
              allVals.push($(this).attr('data-id'));
            });
            if(allVals.length <=0){
              alert('Please select row.');
            }else{
              var check=confirm("Are you sure?");
              var join_selected_values = allVals.join(",");
              $.ajax({
                method:"post",
                url:"{{route('statusChange')}}",
                data:{ids:join_selected_values,status:status},
                success:function(data){
                  console.log(data);
                  jQuery('.alert-success').show();
                  jQuery('.alert-success').append("<p>Message Sent</p>");

                }
              });
            }
          }else{
            alert('Please select subscriber group.');

          }
        });
      });

      // fetch()
      // .then(res => res.json())
      // .then(data => {
      //   document.querySelector('.here').textContent(data.html);
      // })
      // .catch(err => console.log(err));
      $('.getByDate').on('change',function(e) {
        const value = e.target.value;
        console.log(value);
        $.ajax({
          method:'GET',
          url: `/admin/transaction-by-date/${value}`,
          success:function(data) {
            console.log('worked');
            jQuery('.here').replaceWith(data.html);
          }
        });
      })

    </script>
    @endpush