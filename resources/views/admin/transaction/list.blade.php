@extends('layouts.admin')
@section('title','Transaction List')
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
<section class="content-header">
  <h1 style="margin-bottom: 12px">Transaction<small>List</small></h1>
  <div>
    <form method="post" action="{{route('transactionStatus.update')}}" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{ $dashboard_composer->id }}">
      <div class="form-group">
        <label for="submit__transaction">
          <input type="checkbox" id="submit__transaction" name="submit__transaction"
          {{ $dashboard_composer->submit__transaction ? 'checked' : ''}}>
          Enable transaction
        </label>
      </div>
      <button class="btn btn-success">Update</button>
    </form>
    <br>
    {{-- <a class="btn btn-primary" href="{{route('transaction.index')}}">Refresh</a> --}}
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
      <div class="box">
        <div class="row" style="padding: 10px 0">
          <div class="col-md-6">
            <div class="form-group" style="margin-top: 6px; margin-left: 10px;">
              <label>Select By date </label>
              <input type="date" class="form-control getByDate" name="getByDate" >
            </div>
          </div>
          <div class="col-md-6">
            <form method="POST" action="{{route('searchTransaction')}}">
              @csrf
              <div class="form-group" style="padding: 0 20px;">
                <label>Search </label>
                <div style="display: flex;">
                  <input required placeholder="Search" type="text" name="searchData" class="form-control" style="margin-right: 12px">
                  <button type="submit" class="btn btn-success"> Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="box-header">
          <div class="row">
            <h3 class="box-title col-md-8">Data Table</h3>
            <div class="form-group col-md-4">
              <label>Live Search</label>
              <input type="text" name="menuSearch" class="menuSearch form-control" placeholder="Search..." />
            </div>
          </div>
        </div>
        <div class="box-body table-responsive no-padding">
          <div class="row">
            <div class="col-md-6">
              <div class="newsletter hidden">
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
              <div class="w">
                <table id="example1" class="table table-bordered table-striped ">
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
                    <tr class="searchable__list">
                      <td class="searchText">{{$i}}</td>
                      <td class="searchText">{{Carbon\Carbon::parse($detail->created_at)->format('j, M Y ') }}</td>
                      <td class="searchText">
                         @if($detail->status == 2)
                         {{ Carbon\Carbon::parse($detail->received_date)->format('j, M Y ')}}
                          @else N/A
                          @endif
                      </td>
                      <td class="searchText">{{$detail->user->name}}</td>
                      <td class="searchText">{{$detail->user->customerid}}</td>
                      <td class="searchText">@if($detail->type=='Bank-Deposit')
                        {{$detail->account_holder_name}}
                        @else
                        {{$detail->full_name}}
                        @endif
                      </td>
                      <td class="searchText">{{$detail->remit_amount}}</td>
                      <td class="searchText">{{$detail->rate}}</td>
                      <td class="searchText">{{$detail->npr}}</td>

                      <td class="searchText">
                        @if($detail->status == 0)
                        <div data-id="{{$detail->id}}">
                          Pending
                          <input type="checkbox" name="singleCheck" class="sub_chk1" data-id="{{$detail->id}}">
                        </div>
                        @elseif($detail->status==1)
                        <div data-id="{{$detail->id}}">
                          In Progress
                          <input type="checkbox" name="singleCheck" class="sub_chk1" data-id="{{$detail->id}}">
                        </div>
                        @else
                        <div data-id="{{$detail->id}}">
                          Delivered
                        </div>
                        @endif
                      </td>
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
            </div>
            <div class="row">
              <div class="col-md-12" style="margin-bottom: 12px;">{{$details->links()}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>

 <div class="loading hidden">
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
    $('.menuSearch').keyup(function() {
          $('.searchable__list').hide();
          var value = $(this).val().toLowerCase();
          $('.searchable__list').each(function() {
              if ($(this).find('.searchText').text().toUpperCase().indexOf(value.toUpperCase()) != -
                  1) {
                  $(this).show();
              }
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
            $('.loading').removeClass('hidden')
            $.ajax({
              method:"post",
              url:"{{route('statusChange')}}",
              data:{ids:join_selected_values,status:status},
              success:function(data){
                jQuery('.alert-success').show();
                jQuery('.alert-success').append("<p>Message Sent</p>");
                const IDs = data.ids.split(',')
                IDs.forEach((id, key) => {
                  if(data.status == '0') {
                    $(`div[data-id="${id}"]`).html(`
                    Pending <input type="checkbox" name="singleCheck" class="sub_chk1" data-id="${id}" />
                    `)
                  }
                  if(data.status == '1') {
                    $(`div[data-id="${id}"]`).html(`
                    In Progress <input type="checkbox" name="singleCheck" class="sub_chk1" data-id="${id}" />
                    `)
                  }
                  if(data.status == '2') {
                    $(`div[data-id="${id}"]`).html('Delivered')
                  }
                })
                $('.loading').addClass('hidden')
              }
            });
          }
        }else{
          $('.loading').addClass('hidden')
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
        // console.log(value);
        $.ajax({
          method:'GET',
          url: `/admin/transaction-by-date/${value}`,
          success:function(data) {
            // console.log('worked');
            // console.log(data.html);
            jQuery('.here .w').replaceWith(data.html);

          }
        });
      })

    </script>
    @endpush