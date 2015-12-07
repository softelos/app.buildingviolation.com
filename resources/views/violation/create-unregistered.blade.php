@extends('layouts/page')
@section('pageName','Report Violation')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>Report Violation</h2>
			<p>Use this form to report a new building violation:</p>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			{!! Form::model($violation = new \App\Violation,['action'=>'ViolationController@store','files'=>true]) !!}
				@include('violation._form')
			{!! Form::close() !!}			
		</div>
	</div>
	
@endsection
