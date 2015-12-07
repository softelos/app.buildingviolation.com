<p>Hi Admin!</p>

<p>A new <b>@if($user_type=='cus') customer @else pro @endif</b> has registered in <a href="http://app.buildingviolation.com">app.buildingviolation.com</a>!.</p>

<p>You can check his profile <a href="{{action('UserController@show',[$user_id])}}">here</a>.</p>

@include('emails._footer')
