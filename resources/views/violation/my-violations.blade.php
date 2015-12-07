@extends('layouts/page')

@section('pageName','My Violations')

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'my-violations'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>My Violations</h2>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			@if($total)
				<p>You have reported {{ $total }} @if($total>1) violations @else violation @endif:</p>
				@foreach($violations as $violation)
					@include('violation._violation-list')
				@endforeach
			@else
				<p>You have not reported any violations yet.</p>
				<a href="{{ url('report-violation') }}" class="btn btn-default">Report Violation</a>
			@endif
		</div>
	</div>	
@endsection





