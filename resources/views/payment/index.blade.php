@extends('layouts/page')

@section('pageName','Payments')

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'payments'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h3>Payments</h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			@if($payments_count)

				<p>There have been made {{ $payments_count }} payments:</p>
		
				<table id="payments_table" class="table">
					<thead>
						<tr><th>#</th><th>Date</th><th>Time</th><th>Total</th><th>Pro Cost</th><th>Commission</th><th>Fee</th><th>Customer</th><th>Pro</th><th>Paid</th></tr>
					</thead>
					<tbody>
						@foreach($payments as $payment)						
							@include('payment._list-item')						
						@endforeach					
					</tbody>											
				</table>																
			@else
				<p>No payments have been made so far.</p>
			@endif
		</div>
	</div>

@endsection