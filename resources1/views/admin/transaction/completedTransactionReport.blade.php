@extends('layouts.admin')
@section('title','Completed Transaction List')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
<style>

  /* circle loader starts */

  .loading {
      width: 100vw;
      height: 200vw;
      position: fixed;
      top: 0;
      left: 0;
      background: #eef3f7;
      z-index: 9999;
  }

  #wrapper {
      position: relative;
      /*background:#333;*/
      height: 100%;
  }

  .profile-main-loader {
      left: 50% !important;
      margin-left: -100px;
      position: fixed !important;
      top: 50% !important;
      margin-top: -100px;
      width: 45px;
      z-index: 9000 !important;
  }

  .profile-main-loader .loader {
      position: relative;
      margin: 0px auto;
      width: 200px;
      height: 200px;
  }

  .profile-main-loader .loader:before {
      content: "";
      display: block;
      padding-top: 100%;
  }

  .circular-loader {
      -webkit-animation: rotate 2s linear infinite;
      animation: rotate 2s linear infinite;
      height: 100%;
      -webkit-transform-origin: center center;
      -ms-transform-origin: center center;
      transform-origin: center center;
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      margin: auto;
  }

  .loader-path {
      stroke-dasharray: 150, 200;
      stroke-dashoffset: -10;
      -webkit-animation: dash 1.5s ease-in-out infinite,
          color 6s ease-in-out infinite;
      animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
      stroke-linecap: round;
  }

  circle {
      stroke: #d81b1f;
  }

  @-webkit-keyframes rotate {
      100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
      }
  }

  @keyframes rotate {
      100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
      }
  }

  @-webkit-keyframes dash {
      0% {
          stroke-dasharray: 1, 200;
          stroke-dashoffset: 0;
      }

      50% {
          stroke-dasharray: 89, 200;
          stroke-dashoffset: -35;
      }

      100% {
          stroke-dasharray: 89, 200;
          stroke-dashoffset: -124;
      }
  }

  @keyframes dash {
      0% {
          stroke-dasharray: 1, 200;
          stroke-dashoffset: 0;
      }

      50% {
          stroke-dasharray: 89, 200;
          stroke-dashoffset: -35;
      }

      100% {
          stroke-dasharray: 89, 200;
          stroke-dashoffset: -124;
      }
  }

  @-webkit-keyframes color {
      0% {
          stroke: #d81b1f;
      }

      40% {
          stroke: #d81b1f;
      }

      66% {
          stroke: #d81b1f;
      }

      80%,
      90% {
          stroke: #d81b1f;
      }
  }

  @keyframes color {
      0% {
          stroke: #d81b1f;
      }

      40% {
          stroke: #d81b1f;
      }

      66% {
          stroke: #d81b1f;
      }

      80%,
      90% {
          stroke: #d81b1f;
      }
  }

  /* circle loader ends */
</style>
@endpush
@section('content')
<div class="loading d-none">
   <div id="wrapper">
       <div class="profile-main-loader">
           <div class="loader">
               <svg class="circular-loader" viewBox="25 25 50 50">
                   <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#70c542" stroke-width="2">
                   </circle>
               </svg>
           </div>
       </div>

   </div>
</div>
<section class="content-header">
   <h1>Completed Transaction<small>List</small></h1>

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
   <div class="validation_errors">
   </div>
   <div class="row">
      <div class="col-xs-12">
         <div class="box">
            <div class="box-body">
               <form method="post" action="{{route('searchTransactionWithDates')}}">
                  @csrf
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="start_date">
                     </div>
                     <div class="form-group col-md-6">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="end_date">
                     </div>
                     <div class="form-group col-md-6" style="padding: 0 20px;">
                        <label>Sender name</label>
                        <input required placeholder="Search" type="text" name="customer_name" class="form-control"
                           style="margin-right: 12px" id="customer_name">
                     </div>
                     <div class="form-group col-md-6" style="padding: 0 20px;">
                        <label>Customer id</label>
                        <div style="display: flex;">
                           <input required placeholder="Search" type="text" name="customer_id" class="form-control"
                              style="margin-right: 12px" id="customer_id">
                           <button type="submit" class="btn btn-success customDateSearch"> Submit</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>

            <div class="box-body table-responsive">
               <div class="append_search_result">
                  <table class="table table-bordered table-striped  ">
                     <thead>
                        <tr>
                           <th>S.N.</th>
                           <th>Date</th>
                           <th>Sender Name</th>
                           <th>Customer ID</th>
                           <th>Receiver Name</th>
                           <th>Amount($)</th>
                           <th>Rate</th>
                           <th>NPR</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php($i=1)
                        @foreach($details as $detail)
                        <tr>

                           <td>{{$i}}</td>
                           <td>{{Carbon\Carbon::parse($detail->created_at)->format('j, M Y ') }}</td>
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
                           <td>
                              <a class="btn btn-info edit" href="{{route('transaction.show',$detail->id)}}"
                                 title="Edit">View</a>

                           </td>
                        </tr>
                        @php($i++)
                        @endforeach
                     </tbody>
                  </table>
                  {{$details->links()}}
               </div>
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

   function getTransactionWithDates(page) {
        from_date = $('#start_date').val()
        to_date = $('#end_date').val()
        customer_name = $('#customer_name').val()
        customer_id = $('#customer_id').val()

        $('.loading').removeClass('d-none')
        $.ajax({
          method:'post',
          url: "{{ route('searchTransactionWithDates') }}",
          data:{
             from_date,
             to_date,
             customer_name,
             customer_id
          },
          success:function(data){
             if(data.errors) {
               $('.validation_errors').append(data.errors)
             }
            $('.append_search_result').html(data);
            $('.loading').addClass('d-none')
          }
        });
   }
   $(function () {
       $("#example1").DataTable({
         "pageLength": 50
       });
       $('.customDateSearch').click(function(e){
           e.preventDefault()
           getTransactionWithDates()
       });
       $('.pagination li a').click(function(e) {
           e.preventDefault();
           var url = $(this).attr('href');
           $.ajax({
               url: url,
               success: function(data) {
                  $('.append_search_result').html(data);
               }
           });
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

</script>
@endpush