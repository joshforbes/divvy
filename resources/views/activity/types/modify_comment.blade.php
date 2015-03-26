{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} modified a comment on:

@if ( $activity->subject->trashed() || $activity->commentable()->trashed() )
    {{ $activity->commentable()->title ? $activity->commentable()->title : $activity->commentable()->name }}
@else
    <a href="{{ route(strtolower((new \ReflectionClass($activity->subject->commentable))->getShortName()) . '.show', [$activity->subject->commentable->task->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">
        {{ $activity->subject->commentable->title ? $activity->subject->commentable->title : $activity->subject->commentable->name }}
    </a>
@endif