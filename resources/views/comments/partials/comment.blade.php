<div class="comment">
    <div class="comment__sidebar">
        <span class="comment__avatar">{!! $comment->author->profile->present()->avatarHtml('60px') !!}</span>
        <a class="comment__edit-link">edit</a>
        {!! Form::open(['class' => 'comment__delete-form', 'method' => 'DELETE', 'route' => ['comment.destroy', $project->id, $task->id, $comment->id]]) !!}
        <a class="comment__delete-link">delete</a>
        {{--{!! Form::submit('delete', ['class' => 'btn btn-primary form-control']) !!}--}}
        {!! Form::close() !!}
    </div>

    <div class="comment__main-content">
        <p class="comment__meta">
            <a href="{{ route('profile.show', $comment->author->username) }}">{{$comment->author->username}}</a>
            {{ $comment->created_at->diffForHumans() }}
        </p>
        <p class="comment__body">{{ $comment->body }}</p>
        @include('comments.partials.edit-form')

    </div>

</div>
