<div class="violation-top-summary">
	<div class="row">
		<div class="col-md-8">
			<ul>
				<li><span class="ul-label"><i class="fa fa-home"></i> Violation:</span><a href="{{ action('ViolationController@show',[$violation->id]) }}">
					{{ $violation->address1}}, {{ $violation->city}} ({{ $violation->state}}) {{ $violation->zip}}
				</a></li>
				@if($offer->id)
					<li><span class="ul-label"><i class="fa fa-exclamation-triangle"></i> Status:</span>{{ $offer->status }}</li>
					<li><span class="ul-label"><i class="fa fa-usd"></i> Cost:</span>${{ $offer->cost }}</li>
					<li><span class="ul-label"><i class="fa fa-hourglass-half"></i> Duration:</span>{{ $offer->days }} days</li>
				@endif
			</ul>
		</div>

		<div class="col-md-4 text-right">
			@if($offer->id)
				@can('edit-offer',$offer)
					<a href="{{ action('OfferController@edit',[$offer->id]) }}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a><br>
				@endcan
				
				@can('delete-offer',$offer)
					<a href="{{ url('/offer/delete',[$offer->id]) }}" class="btn btn-danger action-confirm" data="Are you sure that you want to delete this offer?"><i class="fa fa-ban"></i> Delete</a><br>
				@endcan
				
				@can('award-offer',$offer)
					<a href="{{ action('OfferController@award',[$offer->id]) }}" class="btn btn-success action-confirm" data="Are you sure that you want to award this offer?"><i class="fa fa-trophy"></i> Award</a><br>
				@endcan

				@can('remove-award',$offer)
					<a href="{{ action('OfferController@remove_award',[$offer->id]) }}" class="btn btn-danger action-confirm" data="Are you sure that you want to revoke the award to this offer?"><i class="fa fa-ban"></i> Revoke Award</a><br>
				@endcan
							
				@can('accept-conditions',$offer)
					<a href="{{ action('OfferController@accept_conditions',[$offer->id]) }}" class="btn btn-success action-confirm" data="Are you sure that you want to accept the conditions submitted by the pro <b>{{$offer->author->username}}</b> for this offer?"><i class="fa fa-check-square-o"></i> Accept Conditions</a><br>
				@endcan
				
				@can('pay-offer',$offer)
					<a href="{{ action('OfferController@pay',[$offer->id]) }}" class="btn btn-success action-confirm action-forwarding" data="Are you sure that you want to pay the amount of <b>{{$payment['total']}}</b> to BuildingViolation for the pro <b>{{$offer->author->username}}</b>?<br><br>If you accept, you will be forwarded to PayPal to process the payment." forward-msg="Forwarding to PayPal, this might take a few seconds.."><i class="fa fa-usd"></i> Pay {{ $payment['total'] }}</a><br>
				@endcan
							
				@can('complete-offer',$offer)
					<a href="{{ action('OfferController@report_completed',[$offer->id]) }}" class="btn btn-success action-confirm" data="Are you sure that you want to report that you have solved this violation?"><i class="fa fa-flag-checkered"></i> Report Completed</a>
				@endcan		

				@can('close-offer',$offer)
					@include('offer._rate')
				@endcan		
			@endif
		</div>		

	</div>
</div>
