<div class="row">
	
	<div class="col-md-6">
		<h3><a href="{{ action('OfferController@show',[$offer->id]) }}">{{ $offer->violation->address1 }}</a></h3>
		<h4>{{ $offer->violation->city }}, {{ $offer->violation->getOriginal('state') }} {{ $offer->violation->zip }}</h4>
		<span class="label label-warning">{{ $offer->violation->type }}</span>
	</div>
	
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-6">Estimated Cost</div><div class="col-md-6">${{ $offer->cost }}</div>
		</div>
		<div class="row">
			<div class="col-md-6">Estimated Time</div><div class="col-md-6">{{ $offer->days }} days</div>
		</div>
		<div class="row">
			<div class="col-md-6">Status</div><div class="col-md-6">{{ $offer->status }}</div>
		</div>
	</div>
</div>