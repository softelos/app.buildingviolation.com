<tr>
	<td>{{$key+1}}</td>
	<td>{{$offer->created_at->toFormattedDateString()}}</td>
	<td><a href="{{ url('/offer/'.$offer->id) }}">{{ ucwords($offer->violation->address1) }}</a></td>
	<td>
		<a href="{{action('UserController@show',[(Auth::user()->getOriginal('user_type')=='pro' ? $offer->violation->author->id : $offer->author->id )])}}">
			@if(Auth::user()->getOriginal('user_type')=='pro') {{$offer->violation->author->username}} @else {{$offer->author->username}} @endif
		</a>
	</td>
	<td>{{ucwords($offer->violation->city)}}</td>
	<td>{{$offer->violation->getOriginal('state')}}</td>
	<td>{{$offer->violation->zip}}</td>
	<td>{{$offer->violation->class}}</td>
	<td>{{$offer->violation->type}}</td>
	<td>{{ ($offer->awarded ? 'Yes' : 'No') }}</td>
	<td>{{ ($offer->getOriginal('status')==6 ? 'Yes' : 'No') }}</td>
</tr>
