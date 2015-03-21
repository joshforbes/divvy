{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} commented on the discussion:
@if ($activity->subject->commentable->trashed())
    {{ $activity->subject->commentable->title }}
@else
    <a href="{{ route('discussion.show', [$activity->subject->commentable->task->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">{{ $activity->subject->commentable->title }}</a>
@endif