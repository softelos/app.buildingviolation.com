@extends('layouts.page')

@section('pageName','Create Offer')

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'my-offers'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>Create Offer</h2>
			<p>Fill the following form to create a new offer:</p>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			{!! Form::model($offer = new \App\Offer,['action'=>'OfferController@store']) !!}
				@include('offer._form')
			{!! Form::close() !!}			
		</div>
	</div>
	
@endsection