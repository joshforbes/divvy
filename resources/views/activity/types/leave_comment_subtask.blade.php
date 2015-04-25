commented on the subtask:
@if ($activity->subject->commentableWithTrashed->trashed())
    {{ $activity->subject->commentableWithTrashed->name }}
@else
    <a href="{{ route('subtask.show', [$activity->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">{{ $activity->subject->commentable->name }}</a>
@endif