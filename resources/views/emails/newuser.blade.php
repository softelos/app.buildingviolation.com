<p>Hi {{$to}}!</p>

<p>Welcome to <a href="http://app.buildingviolation.com">BuildingViolation.com</a>!</p>

@if($user_type=='cus')
	<p>You can now report new building violations <a href="{{action('ViolationController@create')}}">here</a>.</p>
@else
	<p>You can now submit offers to exsiting violations that you can find <a href="{{action('ViolationController@index')}}">here</a>.</p>
@endif

<p>Also don't forget to update your <a href="{{action('UserController@show',[$user_id])}}">profile</a> with more information about you.</p>

@include('emails._footer')
