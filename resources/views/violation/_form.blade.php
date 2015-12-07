@if($errors->any())
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<ul>
				<li>{{ $error }}</li>
			</ul>
		@endforeach
	</div>
@endif

<section id="violation">

	<div class="row">
		<div class="col-md-12 form-group">						
			<h3>Place of Occurance</h3>
			{!! Form::label('address1','Address',['class'=>'required']) !!}
			{!! Form::text('address1',null,['class'=>'form-control','autofocus'=>'autofocus']) !!}
	</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group">
			{!! Form::label('address2','Address 2') !!}
			{!! Form::text('address2',null,['class'=>'form-control']) !!}						
		</div>
	</div>
	<div class="row">	
		<div class="col-md-4 form-group">
			{!! Form::label('city','City',['class'=>'required']) !!}
			{!! Form::text('city',null,['class'=>'form-control']) !!}						
		</div>
		<div class="col-md-4 form-group">
			{!! Form::label('state','State',['class'=>'required']) !!}
			{!! Form::select('state',$states,$violation->getOriginal('state'),['class'=>'form-control']) !!}
		</div>				
		<div class="col-md-4 form-group">
			{!! Form::label('zip','Zip',['class'=>'required']) !!}
			{!! Form::number('zip',null,['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h3>Description</h3>			
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 form-group">
			{!! Form::label('class','Class',['class'=>'required']) !!}
			{!! Form::select('class',$classes,$violation->getOriginal('class'),['class'=>'form-control']) !!}
		</div>
		<div class="col-md-4 form-group">
			{!! Form::label('type','Type',['class'=>'required'],['class'=>'required']) !!}
			{!! Form::select('type',$types,$violation->getOriginal('type'),['class'=>'form-control']) !!}
		</div>
		<div class="col-md-4 form-group">
			{!! Form::label('reporter','Who are you?',['class'=>'required']) !!}
			{!! Form::select('reporter',$reporters,$violation->getOriginal('reporter'),['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 form-group">
			{!! Form::label('ecb','ECB') !!}
			{!! Form::text('ecb',null,['class'=>'form-control']) !!}	
		</div>
	</div>

	<div class="row">	
		<div class="col-md-12 form-group">
			{!! Form::label('description','Description',['class'=>'required']) !!}
			{!! Form::textarea('description',null,['class'=>'form-control text-count','maxlength'=>1000]) !!}
		</div>	
	</div>
					

	
	<div class="row">
		<div class="col-md-12 form-group">
			<h3>Status Information</h3>						
			{!! Form::label('hearing_date_missed','Did you miss the hearing date?') !!}
			{!! Form::radio('hearing_date_missed','No',true,['class'=>'radio-inline']) !!} No
			{!! Form::radio('hearing_date_missed','Yes',false,['class'=>'radio-inline']) !!} Yes						
		</div>	
	</div>
	<div class="row">	
		<div class="col-md-12 form-group">
			{!! Form::label('guilt_admit','Do you admit the violation?') !!}
			{!! Form::radio('guilt_admit','No',false,['id'=>'guilt_admit_0','class'=>'radio-inline']) !!} No
			{!! Form::radio('guilt_admit','Yes',true,['id'=>'guilt_admit_1','class'=>'radio-inline']) !!} Yes						
		</div>	
	</div>

	<div id="guilt_admit" class="hidden">
		<div class="row">
			<div class="col-md-12 form-group">
				{!! Form::label('hearing_date','Hearing Date:') !!}
				{!! Form::date('hearing_date',\Carbon\Carbon::now(),['class'=>'form-control']) !!}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group">
				{!! Form::label('defense','Explain your defense:') !!}
				{!! Form::textarea('defense',null,['class'=>'form-control text-count','maxlength'=>1000]) !!}
			</div>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-12 form-group">
			{!! Form::label('corrected','Is the violation corrected?') !!}
			{!! Form::radio('corrected','No',true,['id'=>'corrected_0','class'=>'radio-inline']) !!} No
			{!! Form::radio('corrected','Yes',false,['id'=>'corrected_1','class'=>'radio-inline']) !!} Yes													
		</div>
	</div>	

	<div id="corrected" class="hidden">
		<div class="row">
			<div class="col-md-6 form-group">
				{!! Form::label('correction_date','Correction Date:') !!}
				{!! Form::date('correction_date',\Carbon\Carbon::now(),['class'=>'form-control']) !!}
			</div>
			<div class="col-md-6 form-group">
				{!! Form::label('correction_author','Corrected By:') !!}
				{!! Form::select('correction_author',$correctors,$violation->getOriginal('correction_author'),['class'=>'form-control']) !!}
			</div>
		</div>
		<div id="contractor" class="hidden">
			<div class="row">
				<div class="col-md-12 form-group">
					{!! Form::label('contractor','Contact information of the person who corrected the violation:') !!}
					{!! Form::textarea('contractor',null,['class'=>'form-control']) !!}
				</div>
			</div>
		</div>						
	</div>	


	<div class="form-group text-center bottom-buttons">

		@if($edit)
			{!! Form::button('<i class="fa fa-check"></i> Update',['type'=>'submit','class'=>'btn btn-default']) !!}	
			<a href="{{ action('ViolationController@show',[$violation->id]) }}" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>	
		@else
			{!! Form::button('<i class="fa fa-check"></i> Send',['type'=>'submit','class'=>'btn btn-default']) !!}	
			<a href="{{ action('SiteController@dashboard') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Cancel</a>	
		@endif

	</div>

</section>
				
