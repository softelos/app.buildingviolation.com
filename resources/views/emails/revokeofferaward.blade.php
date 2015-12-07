<p>Hi {{$to}}!</p>

<p>Customer <b>{{$customer_name}}</b> has revoked the award from the offer you submitted for violation <b>{{$address}}</b>.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
