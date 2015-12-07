@extends('layouts/page')

@section('pageName','Users')

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'users'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>Users</h2>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			@if($users_count)

				<p>There are <b>{{$users_count}}</b> users registered:</p>
		
				<table id="users_table" class="table table-striped">
					<thead>
						<tr><th>#</th><th></th><th>Username</th><th>Type</th><th>Registered</th</tr>
					</thead>
					<tbody>					
						@foreach($users as $user)						
							@include('user._list-item')						
						@endforeach
					</tbody>					
				</table>																
			@else
				<p>There are no users registerd yet.</p>
			@endif
		</div>
	</div>

@endsection