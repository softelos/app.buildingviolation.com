<div class="row">
	<div class="col-md-12">
		<p>Add a new condition to this offer before you start working on it:</p>
	</div>
</div>

@if($errors->any())
	<div class="alert alert-danger">			
		@foreach($errors->get('body') as $error)
			<ul>
				<li>{{ $error }}</li>
			</ul>
		@endforeach
	</div>
@endif

{!! Form::open(['action'=>['ConditionController@store',$offer->id]],['method'=>'post']) !!}
			
	<div class="row">		
		<div class="col-md-9 form-group">
			{!! Form::label('body','Description:') !!}
			{!! Form::text('body',null,['class'=>'form-control text-count','maxlength'=>255]) !!}
		</div>
		<div class="col-md-3 form-group">
			{!! Form::label('deadline','Deadline:') !!}
			{!! Form::date('deadline',null,['class'=>'form-control']) !!}
		</div>			
	</div>
	
	<div class="row">
		<div class="col-md-12 text-right">
			{!! Form::button('<i class="fa fa-check"></i> Add Condition',['type'=>'submit','class'=>'btn btn-success']) !!}
			@can('submit-conditions',$offer)
				<a href="{{ action('OfferController@submit_conditions',[$offer->id]) }}" class="btn btn-default action-confirm" data="Are you sure that you want to submit all the existing conditions to the customer <b>{{$offer->violation->author->username}}</b>?"><i class="fa fa-share-square-o"></i> Submit Conditions</a>	
			@endcan
		</div>
	</div>
	
{!! Form::close() !!}