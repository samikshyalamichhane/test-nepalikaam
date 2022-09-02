@extends('front.userdashboard')

@push('styles')
@endpush

{{-- Latest user dashboard --}}

@section('content')

<section class="list__transaction">
   <div class="container">
      <h4 class="my-3 text-center">Transaction List</h4>
      <div class="overflow-x__auto">
         <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
               <tr>
                  <th scope="col">SN</th>
                  <th scope="col">Sent Date</th>
                  <th scope="col">Delivered Date</th>
                  {{-- <th scope="col">Code</th> --}}
                  <th scope="col">Receiver Name</th>
                  <th scope="col">Type</th>
                  <th>Status</th>
                  <th scope="col">Amount($)</th>
                  <th scope="col">Rate</th>
                  <!-- <th scope="col">Number of transaction</th> -->
                  <th scope="col">Npr</th>
               </tr>
            </thead>
            <tbody>
               @foreach($transactions as $key=>$transaction)
               <tr>
                  <td>{{ ++$key }}</td>
                  <td scope="row">{{ Carbon\Carbon::parse($transaction->created_at)->format('j, M Y ') }}</td>
                  <td scope="row">
                     @if($transaction->status == 2)
                     {{ Carbon\Carbon::parse($transaction->updated_at)->format('j, M Y ')}}
                     @else N/A
                     @endif
                  </td>
                  {{-- <td>{{$transaction->random_token}}</td> --}}
                  <td>@if($transaction->type=='Bank-Deposit')

                     {{$transaction->account_holder_name}}
                     @else
                     {{$transaction->full_name}}
                     @endif
                  </td>
                  <td>{{$transaction->type}}</td>
                  <td>@if($transaction->status==0)
                     Pending
                     @elseif($transaction->status==1)
                     Inprogress
                     @else
                     Delivered
                     @endif
                  </td>
                  <td>{{$transaction->remit_amount}}</td>
                  <td>{{$transaction->rate}}</td>
                  <td>{{$transaction->npr}}</td>
               </tr>

               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection

@push('scripts')
@endpush