@extends('layouts/home')
@section('pageName','Sign In')
@section('pageTitle','Sign in BuildingViolation')

@section('content')

<section id="sign-in" class="autocenter">
	<div class="row">
		<div class="col-md-12">
			@if($errors->any())
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
						<ul>
							<li>{{ $error }}</li>
						</ul>
					@endforeach
				</div>
			@endif

		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			
			{!! Form::open(['method'=>'POST','/login']) !!}
				
				<div class="form-group">
					{!! Form::label('username','Username',['class'=>'required']) !!}
					{!! Form::text('username',null,['class'=>'form-control','autofocus'=>'autofocus']) !!}
					<p class="caption">Enter your BuildingViolation username.</p>
				</div>
				<div class="form-group">
					{!! Form::label('password','Password',['class'=>'required']) !!}
					{!! Form::password('password',['class'=>'form-control']) !!}
					<p class="caption">Enter the password that accompanies your username.</p>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
						{!! Form::checkbox('remember','true',false,['class'=>'']) !!} Remember Me
						</label>
					</div>
				</div>
				<div class="form-group text-center">
					{!! Form::button('<i class="fa fa-sign-in"></i> Sign In',['type'=>'submit','class'=>'btn btn-default']) !!}
				</div>
			
			{!! Form::close() !!}
			
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 text-center">
			<a href="{{url('password/email')}}">Forgot password?</a>
		</div>
	</div>



</section>
	
@endsection

