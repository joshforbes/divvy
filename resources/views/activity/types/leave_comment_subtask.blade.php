{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} commented on the subtask:
@if ($activity->commentable()->trashed())
    {{ $activity->commentable()->name }}
@else
    <a href="{{ route('subtask.show', [$activity->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">{{ $activity->subject->commentable->name }}</a>
@endif