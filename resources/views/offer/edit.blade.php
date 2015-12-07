@extends('layouts.page')

@section('pageName','Edit Offer '.$offer->id)

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'my-offers'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>Edit Offer {{ $offer->id }}</h2>
			<p>Use the form below to change the values of the offer:</p>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			{!! Form::model($offer,['action'=>['OfferController@update',$offer->id],'method'=>'put']) !!}
				@include('offer._form')
			{!! Form::close() !!}			
		</div>
	</div>
	
@endsection