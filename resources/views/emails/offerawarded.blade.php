<p>Hi {{$to}}!</p>

<p>Your offer for violation <b>{{$address}}</b> has been awarded by customer <b>{{$customer_name}}<b>.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
