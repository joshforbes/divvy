{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} removed a task: {{ $activity->subject->name }}
