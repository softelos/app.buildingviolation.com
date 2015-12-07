<p>Hi {{$to}}!</p>

@if($user_type=='cus')
	<p>The customer <b>{{$poster_name}}</b> has posted a new comment to the offer you submitted for violation <b>{{$address}}</b>.</p>
@else
	<p>The pro <b>{{$poster_name}}</b> has posted a new comment to offer #<b>{{$offer_id}}</b> that was submitted for violation <b>{{$address}}</b>.</p>
@endif

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
