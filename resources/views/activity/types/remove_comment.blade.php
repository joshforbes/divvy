removed a comment from the {{strtolower((new \ReflectionClass($activity->subject->commentableWithTrashed))->getShortName())}}:

@if ($activity->subject->commentableWithTrashed->trashed())
    {{ $activity->subject->commentableWithTrashed->title ? $activity->subject->commentableWithTrashed->title : $activity->subject->commentableWithTrashed->name }}
@else
    <a href="{{ route(strtolower((new \ReflectionClass($activity->subject->commentable))->getShortName()) . '.show', [$activity->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">
        {{ $activity->subject->commentable->title ? $activity->subject->commentable->title : $activity->subject->commentable->name }}
    </a>
@endif