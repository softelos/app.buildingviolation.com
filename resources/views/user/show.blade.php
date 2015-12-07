@extends('layouts.page')

@section('pageName',$user->username.'\'s account')


@section('side-bar')
	@include('site._side-bar')
@endsection

@section('content')

<section id="user-profile">

	<div class="row">
		<div class="col-md-12">
			<h2>{{ $user->username }}'s account</h2>
			<h4>Registered {{ $user->created_at->diffForHumans() }}.</h4>
		</div>
	</div>

	<div class="user-profile-box">
		<div class="row">

			<div class="col-md-3 avatar">
				<img src="{{url('uploads/avatars/'.$user->avatar)}}" alt="{{$user->username}}'s avatar" width="150px" height="150px">
			</div>

			<div class="col-md-5">

				<div class="row">
					<div class="col-md-12">
						<h3>General Information</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Name:</label>
						@if($user->firstname)
							<p>{{ $user->firstname }} {{ $user->lastname }}</p>
						@else
							@include('user._edit-to-enter')
						@endif
					</div>
				</div>		

				@can('see-email',$user)
					<div class="row">
						<div class="col-md-12">
							<label>Email:</label>
								<p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
						</div>
					</div>
				@endcan

				<div class="row">
					<div class="col-md-12">
						<label>Account Type:</label>
						<p>{{ $user->user_type }}</p>
					</div>
				</div>			

				@can('see-email',$user)
					<div class="row">
						<div class="col-md-12">
							<label>Address:</label>
							@if($user->address1)
								<address>
									{{ $user->address1 }} @if($user->address2) ,{{ $user->address2 }} @endif<br>
									{{ $user->city }}, {{ $user->state }} {{ $user->zip }}<br>
									@if($user->phone) <abbr title="Phone">P:</abbr> {{ $user->phone }} @endif
								</address>
							@else
								@include('user._edit-to-enter')
							@endif
						</div>
					</div>
				@endcan
			</div>
			<div class="col-md-4">
			
				<div class="row">
					<div class="col-md-12">
						<h3>Account Information</h3>
					</div>
				</div>
				
				@can('see-email',$user)
					<div class="row">
						<div class="col-md-12">
							<label>Paypal Account:</label>
							@if($user->paypal)
								<p>{{ $user->paypal }}</p>
							@else
								@include('user._edit-to-enter')
							@endif
						</div>
					</div>
				@endcan

				@if($user->getOriginal('user_type')=='pro')

					<div class="row">
						<div class="col-md-12">
							<label>Profession:</label>
							<p>{{ $user->pro_type }}</p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<label>Licensed?:</label>
							<p>{{ $user->licensed }}</p>
						</div>
					</div>
					
					@if($user->getOriginal('licensed'))
						<div class="row">
							<div class="col-md-12">
								<label>License Number:</label>
								@if($user->license_number)
									<p>{{ $user->license_number }}</p>
								@else
									@include('user._edit-to-enter')
								@endif
							</div>
						</div>
					@endif
					
					<div class="row">
						<div class="col-md-12">
							<label>Violations solved:</label>
							<p>{{ $user->completed }}</p>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<label>Rate:</label>
							<p><i class="fa fa-star"></i></p>
						</div>
					</div>
					
				@endif

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			@if($user->getOriginal('user_type')=='pro')

				@if($offers_count)
					<div class="row">
						<div class="col-md-12">
							<h3>Submitted Offers ({{$offers_count}})</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
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

						</div>
					</div>							
				@endif		
				
			@else

				@if($violations_count)
					<div class="row">
						<div class="col-md-12">
							<h3>Reported Violations ({{$violations_count}})</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
									<tr><th>#</th><th>Date</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Class</th><th>Type</th><th>Status</th></tr>
								</thead>
								<tbody>
									@foreach($violations as $key=>$violation)
										@include('violation._violation-list-simple')
									@endforeach
								</tbody>
							</table>

						</div>
					</div>							
				@endif

			@endif
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 text-center">
			<a href="{{ action('UserController@edit',[$user->id]) }}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
		</div>
	</div>

</section>

@endsection