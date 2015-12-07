@extends('layouts/page')

@section('pageName','Dashboard')
@section('pageTitle','Welcome '.$user->username.'!')


@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'dashboard'])
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>Welcome {{ $user->username }}!</h2>
			<p>This is a sample text for the home page when the user is not logged in, you need to register, create and account and log in.</p>
		</div>
	</div>
@endsection
