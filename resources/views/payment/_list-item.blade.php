<tr>
	<td><a href="{{ action('OfferController@show',[$payment->offer->id]) }}">{{ $payment->offer->id }}</a></td>
	<td>{{ $payment->created_at->toFormattedDateString() }}</td>
	<td>{{ $payment->created_at->toTimeString() }}</td>
	<td>{{ $payment->total }}</td>
	<td>{{ $payment->cost }}</td>
	<td>{{ $payment->bv_cost }}</td>
	<td>{{ $payment->fee }}</td>
	<td><a href="{{ action('UserController@show',[$payment->author->id]) }}">{{ $payment->author->username }}</a></td>
	<td><a href="{{ action('UserController@show',[$payment->offer->author->id]) }}">{{ $payment->offer->author->username }}</a></td>
	<td>
		@if($payment->paid)
			<i class="fa fa-check text-success" title="Pro has been paid"></i>
			<a href="{{ action('PaymentController@report_unpaid',[$payment->id]) }}" class="text-danger" title="Report as not paid"><i class="fa fa-times"></i></a>
		@else
			<a href="{{ action('PaymentController@report_paid',[$payment->id]) }}" class="btn btn-xs btn-danger" title="Report as paid">Paid</a>
		@endif		
	</td>					
</tr>
