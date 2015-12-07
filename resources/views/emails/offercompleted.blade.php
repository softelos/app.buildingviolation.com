<p>Hi {{$to}}!</p>

<p>The pro <b>{{$pro_name}}</b> has finished working on your violation <b>{{$address}}</b>.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
