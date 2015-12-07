@extends('layouts/page')

@section('pageName','My Offers')

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'my-offers'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>My Offers</h2>
			@if(Auth::user()->getOriginal('user_type')=='cus')
				@if(1)
					<p>You have received <b>{{ $total }}</b> @if($total>1) offers @else offer @endif :</p>
				@else
					<p>You have not received any offers yet.</p>
				@endif
			@else
				@if($total)
					<p>You have submitted <b>{{ $total }}</b> @if($total>1) offers @else offer @endif :</p>
				@else
					<p>You have not submitted any offers yet.</p>
				@endif 
			@endif
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			@if($total>0)
				<table class="table table-striped">
					<thead>
						<tr><th>#</th><th>Date</th><th>Address</th>						
						<th>@if(Auth::user()->getOriginal('user_type')=='pro') To @else From @endif</th>
						<th>City</th><th>State</th><th>Zip</th><th>Class</th><th>Type</th><th>Awarded</th><th>Solved</th></tr>
					</thead>
					<tbody>	
						@foreach($offers as $key=>$offer)
							@include('offer._offer-list-simple')
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
	
@endsection