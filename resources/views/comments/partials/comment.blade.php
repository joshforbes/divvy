<div class="comment">
    <div class="comment__sidebar">
        <span class="comment__avatar">{!! $comment->author->profile->present()->avatarHtml('60px') !!}</span>
    </div>

    <div class="comment__main-content">
        <p class="comment__meta">
            <a href="{{ route('profile.show', $comment->author->username) }}">{{$comment->author->username}}</a>
            {{ $comment->created_at->diffForHumans() }}
        </p>
        <p class="comment__body">{{ $comment->body }}</p>

    </div>

</div>
