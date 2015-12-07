<tr>
	<td>{{$key+1}}</td>
	<td>{{$violation->created_at->toFormattedDateString()}}</td>
	<td><a href="{{ url('/violation/'.$violation->id) }}">{{ ucwords($violation->address1) }}</a></td>
	<td>{{ucwords($violation->city)}}</td>
	<td>{{$violation->getOriginal('state')}}</td>
	<td>{{$violation->zip}}</td>
	<td>{{$violation->class}}</td>
	<td>{{$violation->type}}</td>
	<td>{{$violation->status}}</td>
</tr>
