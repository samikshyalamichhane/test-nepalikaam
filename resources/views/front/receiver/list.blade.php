@extends('front.userdashboard')

@push('styles')
@endpush

@section('content')

<section class="list__transaction">
   <div class="container">
      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible message">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         {!! Session::get('message') !!}
      </div>
      @endif
      <h4 class="my-3 text-center">Receiver List</h4>
      <div class="overflow-x__auto">
         <table id="example2" class="table table-striped table-bordered" style="width:100%">
            <thead>
               <tr>
                  <th scope="col">SN</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Contact number</th>
                  {{-- <th scope="col">Account number</th> --}}
                  <th scope="col">Pick up district</th>
                  <th scope="col">Type</th>
                  <!--<th scope="col">Actions</th>-->
               </tr>
            </thead>
            <tbody>
               @php($i=1)
               @foreach($details as $key=>$detailes)
               <tr>
                  <td>{{$i}}</td>
                  <td>{{ $detailes->type=='Remit' ? $detailes->full_name: $detailes->account_holder_name }}</td>
                  <td>{{ $detailes->type=='Remit' ? $detailes->receiver_contact_number : $detailes->contact_number }}</td>
                  {{-- <td>
                     {{ $detail->account_number ?? 'N/A' }}
                  </td> --}}
                  <td>{{$detailes->pick_up_district ?? 'N/A'}}</td>
                  <td>{{$detailes->type}}</td>
                  {{-- <td>
                     <a class="btn btn-block btn-sm btn-primary" @if(isset($detailes->receiver__id))
                        href="{{route('editReceiver', $detailes->receiver__id)}}"
                        @elseif($detailes->type=='Bank-Deposit')
                        href="{{route('editReceiver', $detailes->account_number)}}"
                        @else
                        href="{{route('editReceiver', $detailes->receiver_contact_number)}}"
                        @endif
                        >
                        Edit
                     </a>
                  </td> --}}
               </tr>
               @php($i++)
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>

@endsection

@push('scripts')
<script>
   $("#example2").DataTable();
</script>
@endpush

{{-- <tr>
   <td>{{++$key}}</td>
<td>{{ $detail->type=='Remit' ? $detail->full_name: $detail->account_holder_name }}</td>
<td>{{ $detail->type=='Remit' ? $detail->receiver_contact_number: $detail->contact_number }}</td>
<td>
   {{ $detail->account_number ?? 'N/A' }}
</td>
<td>{{$detail->pick_up_district ?? 'N/A'}}</td>
<td>{{$detail->type}}</td>

<td>
   <a href="{{route('updateReceiver')}}" class="btn btn-block btn-sm
   btn-primary">Edit</a>
   <form method="post" action="{{route('receiver.destroy',$detail->id)}}" class="delete">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="DELETE">
      <button onclick="return confirm('Are you sure want to delete this ?')" type="submit"
         class="btn btn-block mt-2 btn-danger" style="display:inline">Delete</button>
   </form>
</td>
</tr> --}}