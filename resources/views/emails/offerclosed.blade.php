<p>Hi {{$to}}!</p>

<p>The customer <b>{{$customer_name}}</b> has submitted a review on your offer #<b>{{$offer_id}}</b> for violation <b>{{$address}}</b>.</p>
<p>The violation has been closed.</p>

<p>Check more at {{action('OfferController@show',$offer_id)}}.</p>

@include('emails._footer')
