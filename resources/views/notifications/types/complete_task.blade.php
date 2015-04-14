<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
completed a task:
@if ($notification->subject->trashed())
    {{ $notification->subject->name }}
@else
    <a href="{{ route('task.show', [$notification->project_id, $notification->subject->id]) }}">{{ $notification->subject->name }}</a>
@endif