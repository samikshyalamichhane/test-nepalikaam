@extends('front.userdashboard')

@push('styles')
@endpush

{{-- Latest user dashboard --}}

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-10 m-auto p-4"  style="background-color: #FFFFFF;">
         <h4>Our Bank Details</h4>
            {!!$dashboard_composer->bank__details!!}
            <h3>Notice</h3>
            {!! $dashboard_composer->notice !!}
      </div>
   </div>
</div>
@endsection