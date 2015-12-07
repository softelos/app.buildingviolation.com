<p>Hi {{$to}}!</p>

<p>The customer <b>{{$customer_name}}</b> has placed a payment for the offer #<b>{{$offer_id}}</b> that you submitted for violation <b>{{$address}}</b>.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
