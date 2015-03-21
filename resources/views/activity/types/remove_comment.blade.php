{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} removed a comment from the {{strtolower((new \ReflectionClass($activity->subject->commentable))->getShortName())}}:
"{{ $activity->subject->commentable->name ? $activity->subject->commentable->name : $activity->subject->commentable->title}}"
in task "{{ $activity->subject->commentable->task->name }}"