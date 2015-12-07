@extends('layouts/page-map')
@section('pageName','Violations in '.$state_name)

@if($violations_count)
	@section('pageTitle','There are '.$violations_count.' violations reported in '.$state_name)
@else
	@section('pageTitle','There are no violations reported in '.$state_name)
@endif

@section('extra-js')
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="{{url('/js/map.js')}}"></script>
	<script>
		// Load the map with the location of the violation
		$(document).ready(function(){
	  		drawMap('violations-map','{{$state_name}}',7,false);

	  		@foreach($violations as $violation)
				addMArker('{{$violation->address1}} {{$violation->address2}}, {{$violation->city}}, {{$violation->state}} {{$violation->zip}}','{{$violation->class}}','{{$violation->type}}','{{$violation->status}}','{{$violation->author->username}}','{{$violation->created_at->toFormattedDateString()}}','{{$violation->id}}');
			@endforeach
	  	});
	</script>
@endsection

@section('content')

	<div id="violations-map" style="width:100%;height:100%"></div>

@endsection