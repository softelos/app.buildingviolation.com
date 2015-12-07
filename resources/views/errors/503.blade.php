@extends('layouts/page-error')

@section('pageName','Ooops!')

@section('content')

	<h2>Resource not available.</h2>
	<h4>Go back to the <a href="{{ action('SiteController@dashboard')}}">Dashboard</a>.</h4>			

@endsection