{{ $notification->created_at->diffForHumans() }} -
<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
started a discussion:
@if ($notification->subject->trashed())
    {{ $notification->subject->title }}
@else
    <a href="{{ route('discussion.show', [$notification->project_id, $notification->subject->task->id, $notification->subject->id]) }}">{{ $notification->subject->title }}</a>
@endif
