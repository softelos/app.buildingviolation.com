@extends('layouts/page')

@section('pageName','Offer #'.$offer->id)

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'my-offers'])
@endsection

@section('content')

<section id="offer-page">

	<div class="row">
		<div class="col-md-12">
			<h2>Offer {{ $offer->id }}</h2>
			<h4>Created by <a href="{{ action('UserController@show',[$offer->author->id]) }}">{{ $offer->author->username }}</a>, {{ $offer->created_at->diffForHumans() }}.</h4>
		</div>
	</div>
	
	@include('offer._show-top')
	
	<div class="row">
		<div class="col-md-12">
			<h3>Introduction</h3>
			<p>{{ $offer->introduction }}</p>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<h3>Approach</h3>
			<p>{{ $offer->approach }}</p>
		</div>
	</div>
	
	@if($offer->getOriginal('status')>0)
	
		<div class="row">
			<div class="col-md-12">
				<a name="conditions"></a>
				<h3>Conditions</h3>			
			</div>
		</div>
		
		@if($conditions_count>0)			
			<div class="row">
				<div class="col-md-12">
					@include('condition.conditions-list')
				</div>
			</div>
		@elseif($offer->violation->author->id==Auth::user()->id)
			<div class="row">
				<div class="col-md-12">
					<p>No conditions have been submitted by the pro yet.</p>
				</div>
			</div>
		@endif		
			
	@endif
	
	@can('add-condition',$offer)
		<div class="row">
			<div class="col-md-12">
				@include('condition._form')
			</div>
		</div>
	@endcan

	@if($offer->getOriginal('status')>2)
		<div class="row">
			<div class="col-md-12">
				<h3>Payment</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">		
				@if(!$offer->paid)
					<p>The following payment is pending in order to start working on this offer:</p>
				@else		
					<p>Payment has been made:</p>
				@endif
				
				<table class="table">
					<tr><td>Estimate from Pro</td><td class="text-right">{{ $payment['pro'] }}</td></tr>
					<tr><td>BuildingViolation Fee ({{ $payment['fee'] }})</td><td class="text-right">{{ $payment['bv'] }}</td></tr>
					<tr><td>TOTAL</td><td class="text-right">{{ $payment['total'] }}</td></tr>
				</table>
				
			</div>
		</div>
	@endif
	
	@if($offer->getOriginal('status')==6)
	
		<div class="row">
			<div class="col-md-12">
				<h3>Review</h3>
				<ul>
					<li>Response: {{ $offer->rate->response }}</li>
					<li>Profesionalism: {{ $offer->rate->pro }}</li>
					<li>Quality: {{ $offer->rate->quality }}</li>
				</ul>
			</div>
		</div>
	
	@endif
	
	<div class="row">
		<div class="col-md-12">
			<h3>Comments</h3>
			@if($comments_count>0)
				@include('comment.comments-list')
			@endif
			
			@can('add-comment',$offer)
				@include('comment._form')
			@endcan	
		</div>
	</div>
	
	
		
	<div class="modal fade bs-paypal-modal" tabindex="-1" role="dialog" aria-labelledby="paypal_modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Payment</h3>
				</div>
				<div class="modal-body">
					You will be forwarded to PayPal official website to process the payment for this offer.
				</div>
			</div>
		</div>
	</div>

</section>

	
@endsection
