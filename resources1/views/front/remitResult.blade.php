@extends('layouts.front')
@section('content')
<div class="container">
	<p>@if($value->status==0)
                                Pending
                                @elseif($value->status==1)
                                Approved
                                @else
                                sent
                                @endif</p>
</div>
@endsection