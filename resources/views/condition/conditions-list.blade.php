<a name="conditions"></a>
<p>There are <b>{{ $conditions_count }}</b> conditions:</p>

<table class="table table-striped">
	<thead>
		<tr><th>#</th><th>Description</th><th class="text-center">Deadline</th><th></th></tr>
	</thead>
	<tbody>
		@foreach($conditions as $key=>$condition)		
			@include('condition._conditions-list-item')
		@endforeach
	</tbody>
</table>