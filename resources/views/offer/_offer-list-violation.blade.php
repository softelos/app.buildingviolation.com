<div class="offer status-{{$offer->status}}">
	<div class="row">
		
		<div class="col-md-2 offer-avatar">
			@can('full-view-offer',$offer)
				<a href="{{ action('OfferController@show',[$offer->id]) }}"><img alt="{{$offer->author->username}}'s avatar" src="{{url('/uploads/avatars/',$offer->author->avatar)}}" width="75px" height="75px"></a>
			@else
				<img alt="{{$offer->author->username}}'s avatar" src="{{url('/uploads/avatars/',$offer->author->avatar)}}" width="75px" height="75px">
			@endcan
		</div>
		
		<div class="col-md-7">
			<div class="row">
				<div class="col-md-12 text-left">
					<h4>Sent by <a href="{{ action('UserController@show',$offer->author->id) }}">{{ $offer->author->username }}</a>, {{ $offer->created_at->diffForHumans() }}.</h4>
				</div>
			</div>				
			<div class="row">
				<div class="col-md-12 text-left">
					{{ $offer->introduction }}
				</div>
			</div>
		</div>
		
		<div class="col-md-3 offer-details">
			@can('full-view-offer',$offer)
				<div class="row">
					<div class="col-md-12">
						<span class="offer-label">Cost:</span> ${{ $offer->cost }}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<span class="offer-label">Duration:</span> {{ $offer->days }} days
					</div>
				</div>
			@endcan
			
			<div class="row">
				<div class="col-md-12">
					<span class="offer-label">Status:</span> {{ $offer->status }}
				</div>	
			</div>
			
		</div>
	
	</div>
</div>