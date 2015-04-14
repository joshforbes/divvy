<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
removed a discussion: "{{ $notification->subject->title }}" from the task:
@if ($notification->subject->taskWithTrashed->trashed())
    {{ $notification->subject->taskWithTrashed->name }}
@else
    <a href="{{ route('task.show', [$notification->project_id, $notification->subject->task->id]) }}">{{ $notification->subject->task->name }}</a>
@endif