<div class="row list-item violation-item">
	
	<span class="violation-{{$violation->getOriginal('class')}}"></span>
	<span class="violation-{{$violation->getOriginal('type')}}"></span>
	<span class="status-{{$violation->status}}"></span>
	<span class="state-{{$violation->state}}"></span>

	<span class="date-filter">{{$violation->created_at->toFormattedDateString()}}</span>

	<div class="col-md-5 violation-img">
		<a href="{{ url('/violation/'.$violation->id) }}">
			<img class="map-view" alt="" src="https://maps.googleapis.com/maps/api/streetview?size=300x185&amp;location={{ $violation->address1}},{{ $violation->city }},{{ $violation->getOriginal('state')}},{{ $violation->zip}};heading=250&amp;pitch=-0.76&amp;key={{ config('other.googleAPIKey')}}">
		</a>
	</div>
	
	<div class="col-md-5 violation-body">
		<a href="{{ url('/violation/'.$violation->id) }}"><h3>{{ ucwords($violation->address1) }}</h3></a>
		<h4>{{ ucwords($violation->city) }}, <span class="state">{{ $violation->getOriginal('state') }}</span> {{ $violation->zip }}</h4>
		
		@if($violation->author->id==Auth::user()->id)
			<p class="violation-reported-by">You reported this violation {{ $violation->created_at->diffForHumans() }}.</p>
		@else
			<p class="violation-reported-by">Reported by <a href="{{ action('UserController@show',[$violation->author->id]) }}">{{ $violation->author->username }}</a>, {{ $violation->created_at->diffForHumans() }}.</p>
		@endif

		<div class="violation-labels">
			<span class="label label-warning">{{ $violation->class }}</span>
			<span class="label label-success">{{ $violation->type }}</span>
		</div>
		@if($violation->ecb)
			<p class="violation-ecb">ECB {{ $violation->getShortECB() }}</p>
		@endif
		<p>{{ $violation->getShortDescription(260) }}</p>
	</div>
	
	<div class="col-md-2 violation-side">
		<div class="row">
			<div class="col-md-6 left">Corrected</div><div class="col-md-6 right">{{ $violation->corrected }}</div>
		</div>
		<div class="row">
			<div class="col-md-6 left">Status</div>
			<div class="col-md-6 right">{{ $violation->status }}</div>
		</div>
		@if($violation->getOriginal('status')>0)
		<div class="row">
			<div class="col-md-6 left">Pro</div>
			<div class="col-md-6 right"><a href="{{action('UserController@show',[$violation->proAwarded->id])}}">{{ $violation->proAwarded->username }}</a></div>
		</div>		
		@endif
		<div class="row">
			<div class="col-md-6 left">Offers</div><div class="col-md-6 right">{{ $violation->offers }}</div>
		</div>
	</div>
</div>
