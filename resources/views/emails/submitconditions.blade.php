<p>Hi {{$to}}!</p>

<p>The pro <b>{{$pro_name}}</b> has submitted conditions to offer #<b>{{$offer_id}}</b> awarded for violation <b>{{$address}}</b>.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
