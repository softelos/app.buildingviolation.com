@if($errors->any())
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			<ul>
				<li>{{ $error }}</li>
			</ul>
		@endforeach
	</div>
@endif

@include('offer._show-top')

<div class="form-group">
	{!! Form::label('introduction','Introduce yourself to the customer:') !!}
	{!! Form::text('introduction',null,['class'=>'form-control text-count','maxlength'=>'150']) !!}
</div>
<div class="form-group">
	{!! Form::label('approach','Describe your approach to solve the violation:') !!}
	{!! Form::textarea('approach',null,['class'=>'form-control text-count','maxlength'=>'1000']) !!}
</div>

<div class="row">
	<div class="col-md-6 form-group">
		{!! Form::label('cost','Estimated cost:') !!}
		{!! Form::number('cost',null,['class'=>'form-control']) !!}
	</div>
	<div class="col-md-6 form-group">
		{!! Form::label('days','Estimated days to complete:') !!}
		{!! Form::number('days',null,['class'=>'form-control']) !!}		
	</div>
</div>

<div class="form-group text-center">
	@if($edit)
		{!! Form::button('<i class="fa fa-check"></i> Update',['type'=>'submit','class'=>'btn btn-default']) !!}
	@else
		{!! Form::button('<i class="fa fa-check"></i> Submit',['type'=>'submit','class'=>'btn btn-default']) !!}
	@endif	
	<a href="{{ action('OfferController@show',[$offer->id]) }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>	
	{!! Form::hidden('violation_id',$violation->id) !!}
</div>

