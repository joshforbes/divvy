{{ $notification->created_at->diffForHumans() }} -
<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
removed a comment from the {{strtolower((new \ReflectionClass($notification->subject->commentable))->getShortName())}}:
@if ($notification->subject->commentable->trashed())
    {{ $notification->subject->commentable->title ? $notification->subject->commentable->title : $notification->subject->commentable->name }}
@else
    <a href="{{ route(strtolower((new \ReflectionClass($notification->subject->commentable))->getShortName()) . '.show', [$notification->project_id, $notification->subject->commentable->task->id, $notification->subject->commentable->id]) }}">
        {{ $notification->subject->commentable->title ? $notification->subject->commentable->title : $notification->subject->commentable->name }}
    </a>
@endif
