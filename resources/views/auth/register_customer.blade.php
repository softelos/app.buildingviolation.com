@extends('layouts/home')
@section('pageName','New Customer Account')
@section('pageTitle','New Customer Account')

@section('content')

<section id="register-user" class="autocenter">

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
			
			{!! Form::open(['method'=>'POST','url'=>'/signup-customer']) !!}
	
				<div class="form-group">
					{!! Form::label('username','Username:',['class'=>'required']) !!}
					{!! Form::text('username',null,['class'=>'form-control','autofocus'=>'autofocus']) !!}
					<p class="caption">Enter a username that doesn't exceed 60 characters.</p>
				</div>			
				<div class="form-group">
					{!! Form::label('email','Email:',['class'=>'required']) !!}
					{!! Form::text('email',null,['class'=>'form-control']) !!}
					<p class="caption">The e-mail address is not made public and will only be used to receive a new password or certain notifications by e-mail.</p>
				</div>
				<div class="form-group">
					{!! Form::label('password','Password:',['class'=>'required']) !!}
					{!! Form::password('password',['class'=>'form-control']) !!}
					<p class="caption">Provide a password for the new account that is at least 8 characters long.</p>
				</div>
				<div class="form-group">
					{!! Form::label('password_confirmation','Confirm Password:',['class'=>'required']) !!}
					{!! Form::password('password_confirmation',['class'=>'form-control']) !!}
					<p class="caption">Re-enter your password to confirm that is correct.</p>
				</div>
									
				<div class="form-group text-center">
					{!! Form::button('<i class="fa fa-sign-in"></i> Register',['type'=>'submit','class'=>'btn btn-default']) !!}
				</div>
			</form>
			
			{!! Form::close() !!}
			
			</div>
	</div>
    <div class="row">
        <div class="col-md-12 center">
            <p>Already have an account? <a href="{{url('sign-in')}}">Sign in</a></p>
        </div>
    </div>
</section>


@endsection