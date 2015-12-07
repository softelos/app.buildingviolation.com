
@if($errors->any())
	<div class="alert alert-danger">			
		@foreach($errors->get('body') as $error)
			<ul>
				<li>{{ $error }}</li>
			</ul>
		@endforeach
	</div>
@endif

{!! Form::open(['action'=>['CommentController@store',$offer->id]],['method'=>'post']) !!}
	<div class="row">
		<div class="col-md-12 form-group">
			{!! Form::label('body','Enter a new comment:') !!}
			{!! Form::textarea('body',null,['class'=>'form-control text-count','rows'=>5,'maxlength'=>255]) !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-right">
			{!! Form::button('<i class="fa fa-share-square-o"></i> Add Comment',['type'=>'submit','class'=>'btn btn-success']) !!}
		</div>
	</div>
{!! Form::close() !!}