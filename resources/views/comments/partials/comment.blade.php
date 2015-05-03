<div class="comment" data-comment="{{ $comment->id }}">
    <div class="comment__avatar">
        {!! $comment->author->profile->present()->avatarHtml('60px') !!}
    </div>

    <div class="comment__main-content">
        <div class="comment__meta">
            <a class="comment__author" href="{{ route('activity.showTask', [$project->id, $task->id, $comment->author->username]) }}">{{$comment->author->username}}</a>
            <span class="comment__timestamp">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <div class="comment__body">
            {{ $comment->body }}
        </div>

    </div>
    @if(Auth::user()->isCommentAuthor($comment->id))

        <button class="comment__settings-button"><i class="fa fa-gear"></i></button>

        <div class="comment__settings-overlay hide">
            <button class="comment__settings-close"><i class="fa fa-times"></i></button>
            <div class="comment__settings">
                <button class="comment__setting" data-toggle="modal" data-target={{"#" . $comment->id . "-modal"}}>
                    <i class="fa fa-edit"></i>Edit
                </button>

                {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['comment.destroy', $project->id, $task->id, $comment->id]]) !!}
                <button class="comment__setting">
                    <i class="fa fa-trash"></i>Delete
                </button>
                {!! Form::close() !!}
            </div>
        </div>

    @endif
</div>