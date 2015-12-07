@extends('layouts/page')
@section('pageName','Violation at '.$violation->address1)

@section('extra-js')
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="{{url('/js/map.js')}}"></script>
	<script>
		// Load the map with the location of the violation
		$(document).ready(function(){
	  		drawMap('violation-map','{{ $violation->address1 }} {{ $violation->city }} {{ $violation->getOriginal('state') }} {{ $violation->zip }}',10,true);
	  	});
	</script>
@endsection

@section('side-bar')
	@if($owned_by_user)
		@include('site._side-bar',['sidebar_active_menu'=>'my-violations'])
	@else
		@include('site._side-bar',['sidebar_active_menu'=>'violations'])
	@endif
@endsection

@section('content')
	<section id="violation-page">
		<div class="row">
			<div class="col-md-12">
				<h2>{{ $violation->address1 }}, {{ $violation->city }} ({{ $violation->getOriginal('state') }}) {{ $violation->zip }}</h2>
				@if($violation->author->id==Auth::user()->id)
					<h4>You reported this violation {{ $violation->created_at->diffForHumans() }}.</h4>
				@else
					<h4>Reported by <a href="{{ url('/user/'.$violation->author->id) }}">{{ $violation->author->username }}</a>, {{ $violation->created_at->diffForHumans() }}.</h4>
				@endif					
				@if($violation->ecb)
					<p class="violation-ecb">ECB {{$violation->ecb}}</p>
				@endif
			</div>
		</div>

		@include('violation._show-top')
		
		<div class="row">
			<div class="col-md-12">
				<h3>Description</h3>
				<p>{{ $violation->description }}</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<img class="map-view" alt="" src="https://maps.googleapis.com/maps/api/streetview?size=400x250&amp;location={{ $violation->address1}},{{ $violation->city }},{{ $violation->getOriginal('state')}},{{ $violation->zip}};heading=250&amp;pitch=-0.76&amp;key={{ config('other.googleAPIKey')}}">
			</div>	
			<div class="col-md-6">
				<div id="violation-map" style="width:400px;height:250px;border-radius:10px"></div>
			</div>	
		</div>

		@if(!$violation->getOriginal('guilt_admit'))
			<div class="row">
				<div class="col-md-12">
					<h3>Court</h3>
					<p>The reporter doesn't admit guilt on this violation and has a date and defense for the hearing:</p>
				</div>
			</div>
			<div class="row">				
				<div class="col-md-3">
					<strong>Date</strong>
					<p>{{ $violation->hearing_date->toFormattedDateString() }}</p>
				</div>
				<div class="col-md-9">
					<strong>Defense</strong>
					<p>{{ $violation->defense }}</p>
				</div>
			</div>
		@endif
		
		@if($violation->getOriginal('corrected'))
			<div class="row">
				<div class="col-md-12">
					<h3>Correction</h3>
					<p>This violation has been already corrected:</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<strong>Date</strong>
					<p>{{ $violation->correction_date }}</p>
				</div>
				<div class="col-md-3">
					<strong>Author</strong>
					<p>{{ $violation->correction_author }}.</p>
				</div>
				@if($violation->getOriginal('correction_author')!='myself')
					<div class="col-md-6">
						<strong>Author's details</strong>
						<p>{{ $violation->contractor }}</p>
					</div>
				@endif
			</div>
		@endif
		
		@if($total_offers)
			<div class="row">
				<div class="col-md-12">
					<h3>Offers</h3>
					@foreach($offers as $offer)
						@include('offer._offer-list-violation')
					@endforeach				
				</div>
			</div>
		@endif
		
		<div class="row">
			<div class="col-md-12 text-center bottom-buttons">
				@can('edit-violation',$violation)
					<a href="{{ action('ViolationController@edit',[$violation->id]) }}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
				@endcan
				
				@can('delete-violation',$violation)
					<a href="{{ url('/violation/delete',[$violation->id]) }}" class="btn btn-danger action-confirm" data="Are you sure you want to delete this violation?"><i class="fa fa-ban"></i> Delete</a>
				@endcan
				
				@can('create-offer')
					@can('send-offer',$violation)
						<a href="{{ action('OfferController@create',[$violation->id]) }}" class="btn btn-default"><i class="fa fa-usd"></i> Submit Offer</a>
					@endcan
				@endcan
			</div>
		</div>
	</section>
	
@endsection



