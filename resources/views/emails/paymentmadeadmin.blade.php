<p>Hello {{$to}}!</p>

<p>The customer <b>{{$customer_name}}</b> has placed a payment for the offer #<b>{{$offer_id}}</b> that was submitted by the pro <b>{{$pro_name}}</b> for violation <b>{{$address}}</b>.</p>

<p>Check more at {{action('PaymentController@index')}}.</p>

@include('emails._footer')
