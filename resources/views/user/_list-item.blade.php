<tr>
	<td><a href="{{ action('UserController@show',[$user->id]) }}">{{ $user->id }}</a></td>
	<td><a href="{{ action('UserController@show',[$user->id]) }}"><img src="{{ url('/uploads/avatars/'.$user->avatar) }}" alt="{{$user->username}}'s avatar" title="{{$user->username}}'s avatar" width="50px" height="50px"></a></td>
	<td><a href="{{ action('UserController@show',[$user->id]) }}">{{ $user->username }}</a></td>
	<td>{{ $user->user_type }}</td>
	<td>{{ $user->created_at->diffForHumans() }}</td>
</tr>
