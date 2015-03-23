{{ $notification->created_at->diffForHumans() }} -
<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
removed a discussion: "{{ $notification->subject->title }}" from the task:
<a href="{{ route('task.show', [$notification->project_id, $notification->subject->task->id]) }}">{{ $notification->subject->task->name }}</a>
