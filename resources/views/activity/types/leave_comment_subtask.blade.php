{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} commented on the subtask:
@if ($activity->subject->commentable->trashed())
    {{ $activity->subject->commentable->name }}
@else
    <a href="{{ route('subtask.show', [$activity->subject->commentable->task->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">{{ $activity->subject->commentable->name }}</a>
@endif