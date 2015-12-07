@extends('layouts.page')

@section('pageName','Edit '.$user->username.'\'s account')

@section('top-css')
	<link href="{{url('/js/vendor/upload/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('extra-js')
	<script src="{{url('/js/vendor/upload/js/plugins/canvas-to-blob.min.js')}}" type="text/javascript"></script>
	<script src="{{url('/js/vendor/upload/js/fileinput.min.js')}}"></script>
@endsection

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'account'])
@endsection

@section('content')

	<div class="row">
		<div class="col-md-12">
			<h2>Edit {{ $user->username }}'s account</h2>
			<p>Use the form below to edit your profile:</p>
		</div>
	</div>
	
	<section>

	{!! Form::model($user,['action'=>['UserController@update',$user->id],'method'=>'put','files'=>true]) !!}

		<div class="row">
			<div class="col-md-12">
				@if($errors->any())
					<div class="alert .alert-dismissible alert-danger">
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

			<div class="col-md-3">
		
				<div class="row">
					<div class="col-md-12 text-center">
						{!! Form::file('avatar',[
							'class'=>'file',
							'data-preview-file-type'=>'text',
							'data-show-caption'=>false, 
							'data-show-upload'=>false,
							'data-show-remove'=>false,
							'data-show-close'=>false,
							'data-allowed-file-types'=>'["image"]',
							'data-default-preview-content'=>'<img src="/uploads/avatars/'.$user->avatar.'">',
							'data-initial-preview'=>'<img src="/uploads/avatars/'.$user->avatar.'">',
							'data-preview-settings'=>'image: {width: "150px", height: "150px"}',
							'data-max-file-size'=>100,
							'data-resize-image'=>true										
						]) !!}
					</div>											
				</div>
			</div>

			<div class="col-md-9">

				<div class="row">
					<div class="col-md-12">
						<h3>General Information</h3>
					</div>
				</div>

				<div class="row">		
					<div class="col-md-6 form-group">
						{!! Form::label('firstname','Firstname:',['class'=>'required']) !!}
						{!! Form::text('firstname',null,['class'=>'form-control','autofocus'=>'autofocus']) !!}
					</div>
					<div class="col-md-6 form-group">
						{!! Form::label('lastname','Lastname:',['class'=>'required']) !!}
						{!! Form::text('lastname',null,['class'=>'form-control']) !!}
					</div>
				</div>
			
				<div class="row">
					<div class="col-md-12 form-group">
						{!! Form::label('address1','Address:',['class'=>'required']) !!}
						{!! Form::text('address1',null,['class'=>'form-control']) !!}
					</div>
				</div>
			
				<div class="row">		
					<div class="col-md-12 form-group">
						{!! Form::label('address2','Address 2:') !!}
						{!! Form::text('address2',null,['class'=>'form-control']) !!}
					</div>
				</div>
			
				<div class="row">		
					<div class="col-md-4 form-group">
						{!! Form::label('city','City:',['class'=>'required']) !!}
						{!! Form::text('city',null,['class'=>'form-control']) !!}
					</div>
					<div class="col-md-4 form-group">
						{!! Form::label('state','State:',['class'=>'required']) !!}
						{!! Form::select('state',$states,$user->getOriginal('state'),['class'=>'form-control']) !!}
					</div>
					<div class="col-md-4 form-group">
						{!! Form::label('zip','Zip:',['class'=>'required']) !!}
						{!! Form::text('zip',null,['class'=>'form-control']) !!}
					</div>
				</div>
				
				<div class="row">		
					<div class="col-md-12 form-group">
						{!! Form::label('phone','Phone:') !!}
						{!! Form::text('phone',null,['class'=>'form-control']) !!}
						<p class="caption">The format of the phone number must be (XXX) XXX-XXXX .</p>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<h3>Account Information</h3>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6 form-group">
						{!! Form::label('password','Password:') !!}
						{!! Form::password('password',['class'=>'form-control']) !!}
					</div>
					<div class="col-md-6 form-group">
						{!! Form::label('password_confirmation','Confirm Password:') !!}
						{!! Form::password('password_confirmation',['class'=>'form-control']) !!}
					</div>
				</div>
			
				@if($user->getOriginal('user_type')=='pro')
			
					<div class="row">
						<div class="col-md-12 form-group">
							{!! Form::label('pro_type','Profession:') !!}
							{!! Form::select('pro_type',$pro_types,$user->getOriginal('pro_type'),['class'=>'form-control']) !!}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 form-group">
							{!! Form::label('licensed','Are you licensed?:') !!}
							<label>{!! Form::radio('licensed','No',true,['id'=>'licensed_0','class'=>'radio-inline']) !!} No</label>
							<label>{!! Form::radio('licensed','Yes',false,['id'=>'licensed_1','class'=>'radio-inline']) !!} Yes</label>						
						</div>
					</div>

					<div id="license-number" class="row hidden">
						<div class="col-md-12 form-group">
							{!! Form::label('license_number','License Number:') !!}
							{!! Form::text('license_number',null,['class'=>'form-control']) !!}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 form-group">
							{!! Form::label('paypal','Paypal Account:') !!}
							{!! Form::text('paypal',null,['class'=>'form-control']) !!}
						</div>
					</div>
				@endif
			</div>

		</div>



		<div class="row">		
			<div class="row">
				<div class="col-md-12 text-center">
					{!! Form::button('<i class="fa fa-check"></i> Update',['type'=>'submit','class'=>'btn btn-default']) !!}	
					<a href="{{ action('UserController@show',$user->id) }}" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>	
				</div>
			</div>
		</div>
				
	{!! Form::close() !!}

	</section>
			
@endsection
