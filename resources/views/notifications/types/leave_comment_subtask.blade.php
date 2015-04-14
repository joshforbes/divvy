<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
commented on a subtask:
@if ($notification->subject->commentableWithTrashed->trashed())
    {{ $notification->subject->commentableWithTrashed->name }}
@else
    <a href="{{ route('subtask.show', [$notification->project_id, $notification->subject->commentable->task->id, $notification->subject->commentable->id]) }}">{{ $notification->subject->commentable->name }}</a>
@endif