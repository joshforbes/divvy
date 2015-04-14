<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
re-opened a subtask:
@if ($notification->subject->trashed())
    {{ $notification->subject->name }}
@else
    <a href="{{ route('subtask.show', [$notification->project_id, $notification->subject->task->id, $notification->subject->id]) }}">{{ $notification->subject->name }}</a>
@endif
