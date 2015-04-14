<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
modified a comment on the {{ strtolower((new \ReflectionClass($notification->subject->commentableWithTrashed))->getShortName()) }}:
@if ($notification->subject->commentableWithTrashed->trashed())
    {{ $notification->subject->commentableWithTrashed->title ? $notification->subject->commentableWithTrashed->title : $notification->subject->commentableWithTrashed->name }}
@else
    <a href="{{ route(strtolower((new \ReflectionClass($notification->subject->commentable))->getShortName()) . '.show', [$notification->project_id, $notification->subject->commentable->task->id, $notification->subject->commentable->id]) }}">
        {{ $notification->subject->commentable->title ? $notification->subject->commentable->title : $notification->subject->commentable->name }}
    </a>
@endif
