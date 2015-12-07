@extends('layouts/page')
@section('pageName','Edit Violation')

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'my-violations'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>Edit Violation</h2>
			<p>Review and change the following form if you want to change the violation:</p>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			{!! Form::model($violation,['action'=>['ViolationController@update',$violation->id],'method'=>'put']) !!}
				@include('violation._form')
			{!! Form::close() !!}			
		</div>
	</div>
	
@endsection
