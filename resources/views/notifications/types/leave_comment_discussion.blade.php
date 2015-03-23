{{ $notification->created_at->diffForHumans() }} -
<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
commented on a discussion:
@if ($notification->subject->commentable->trashed())
    {{ $notification->subject->commentable->title }}
@else
    <a href="{{ route('discussion.show', [$notification->project_id, $notification->subject->commentable->task->id, $notification->subject->commentable->id]) }}">{{ $notification->subject->commentable->title }}</a>
@endif

