{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} removed a discussion: "{{ $activity->subject->title }}" from the task "{{ $activity->subject->taskWithTrashed->name }}"

