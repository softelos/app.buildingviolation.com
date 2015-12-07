<a name="comment_{{$comment->id}}"></a>
<div class="comment">	
	<div class="row">
		<div class="col-md-3 comment-avatar">
			<a href="{{ action('UserController@show',[$comment->author->id])}}">
				<img src="{{ url('/uploads/avatars/'.$comment->author->avatar) }}" width="75px" height="75px" title="{{ $comment->author->username }}" alt="{{ $comment->author->username }}"/>
			</a>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-12">
					<p><a href="{{ action('UserController@show',[$comment->author->id]) }}">{{ $comment->author->username }}</a>, {{ $comment->created_at->diffForHumans() }}.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{ $comment->body }}
				</div>
			</div>
		</div>
	</div>
</div>