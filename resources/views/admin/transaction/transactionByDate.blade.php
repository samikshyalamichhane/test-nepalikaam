 <div class="w">
   <table class="table table-bordered table-striped ">
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
      @if($details->isNotEmpty())
      @php($i=1)
      @foreach($details as $detail)
      <tr class="searchable__list">

        <td class="searchText">{{$i}}</td>
        <td class="searchText">{{Carbon\Carbon::parse($detail->created_at)->format('j, M Y ') }}</td>
        <td class="searchText">
          @if($detail->status == 2)
          {{ Carbon\Carbon::parse($detail->updated_at)->format('j, M Y ')}}
          @else N/A
        @endif</td>
        <td class="searchText">{{$detail->name}}</td>
        <td class="searchText">{{$detail->customerid}}</td>
        <td class="searchText">@if($detail->type=='Bank-Deposit')
          {{$detail->account_holder_name}}
          @else
          {{$detail->full_name}}
          @endif
        </td>
        <td class="searchText">{{$detail->remit_amount}}</td>
        <td class="searchText">{{$detail->rate}}</td>
        <td class="searchText">{{$detail->npr}}</td>

        <td class="searchText">@if($detail->status==0)
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
        @else
        <td>No data found</td>
        @endif
      </tbody>
    </table>
  </div>
</div>