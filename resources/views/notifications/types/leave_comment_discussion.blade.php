<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
commented on a discussion:
@if ($notification->subject->commentableWithTrashed->trashed())
    {{ $notification->subject->commentableWithTrashed->title }}
@else
    <a href="{{ route('discussion.show', [$notification->project_id, $notification->subject->commentable->task->id, $notification->subject->commentable->id]) }}">{{ $notification->subject->commentable->title }}</a>
@endif

