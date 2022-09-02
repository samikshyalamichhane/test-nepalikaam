<table class="table table-bordered table-striped">
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
         <a class="btn btn-info edit" href="{{route('transaction.show',$detail->id)}}" title="Edit">View</a>
       </td>
     </tr>
     @php($i++)
     @endforeach
     <tr>
      <td colspan="6" class="text-right">Total Amount: {{ $details->sum('remit_amount') }}</td>
    </tr>
   </tbody>
</table>