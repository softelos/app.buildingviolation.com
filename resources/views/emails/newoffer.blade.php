<p>Hi {{$to}}!</p>

<p>The pro <b>{{$pro_name}}</b> has submitted a new offer for the violation you have reported for <b>{{$address}}</b>.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
