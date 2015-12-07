<p>Hi {{$to}}!</p>

<p>The customer <b>{{$customer_name}}</b> has accepted the conditions you submitted for offer #<b>{{$offer_id}}</b>, awarded for violation <b>{{$address}}</b>.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
