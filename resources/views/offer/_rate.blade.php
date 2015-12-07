{!! Form::open(['action'=>['RateController@store',$offer->id]],['method'=>'post','class'=>'form-inline']) !!}
	<div class="row rate-form">
		<div class="row form-group rate-option">
			<div class="col-md-6 rate-label">{!! Form::label('response','Response') !!}</div>
			<div class="col-md-6">{!! Form::select('response',$rates,null,['class'=>'form-control']) !!}</div>
		</div>
		<div class="row form-group rate-option">
			<div class="col-md-6 rate-label">{!! Form::label('pro','Professionalism') !!}</div>
			<div class="col-md-6">{!! Form::select('pro',$rates,null,['class'=>'form-control']) !!}</div>
		</div>
		<div class="row form-group rate-option">
			<div class="col-md-6 rate-label">{!! Form::label('quality','Quality') !!}</div>
			<div class="col-md-6">{!! Form::select('quality',$rates,null,['class'=>'form-control']) !!}</div>	
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				{!! Form::button('<i class="fa fa-check"></i> Report Closed',['type'=>'submit','class'=>'btn btn-success action-confirm','data'=>'Are you sure that you want to submit a review for this offer? If you do so, you will close the offer.']) !!}				
			</div>
		</div>
	</div>	
{!! Form::close() !!}