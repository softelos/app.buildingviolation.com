<tr>
	<td>{{ $key+1 }}</td>
	<td>{{ $condition->body }}</td>
	<td class="text-center">
		@if($condition->deadline)
			{{ Carbon\Carbon::parse($condition->deadline)->toFormattedDateString() }}
		@else
			-
		@endif
	</td>
	<td class="text-center">
		@can('delete-condition',$condition)
			<a title="Delete this condition" href="{{ action('ConditionController@destroy',[$condition->id]) }}" class="text-danger action-confirm" data="Are you sure that you want to delete this condition?"><i class="fa fa-times"></i></a>
		@endcan
	</td>
</tr>