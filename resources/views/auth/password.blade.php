@extends('layouts/home')
@section('pageName','Reset Password')
@section('pageTitle','Reset Password')

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
			
			{!! Form::open(['method'=>'POST','url'=>'/password/email']) !!}

				{!! Form::token() !!}
				
				<div class="form-group">
					{!! Form::label('email','Email',['class'=>'required']) !!}
					{!! Form::email('email',old('email'),['class'=>'form-control','autofocus'=>'autofocus']) !!}
					<p class="caption">Enter your BuildingViolation email to reset your password.</p>
				</div>
				<div class="form-group text-center">
					{!! Form::button('<i class="fa fa-sign-in"></i> Reset',['type'=>'submit','class'=>'btn btn-default']) !!}
				</div>
			
			{!! Form::close() !!}
			
		</div>
	</div>
</section>
	
@endsection

