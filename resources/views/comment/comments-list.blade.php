<p>There are {{ $comments_count }} comments:</p>

@foreach($comments as $comment)

	@include('comment._comments-list-item',[$comment])
	
@endforeach