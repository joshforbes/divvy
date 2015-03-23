{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} removed a comment from the {{strtolower((new \ReflectionClass($activity->subject->commentable))->getShortName())}}:
@if ($activity->subject->commentable->trashed())
    {{ $activity->subject->commentable->title ? $activity->subject->commentable->title : $activity->subject->commentable->name }}
@else
    <a href="{{ route(strtolower((new \ReflectionClass($activity->subject->commentable))->getShortName()) . '.show', [$activity->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">
        {{ $activity->subject->commentable->title ? $activity->subject->commentable->title : $activity->subject->commentable->name }}
    </a>
@endif