{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} commented on the discussion:
@if ($activity->subject->commentableWithTrashed->trashed())
    {{ $activity->subject->commentableWithTrashed->title }}
@else
    <a href="{{ route('discussion.show', [$activity->project_id, $activity->subject->commentable->task->id, $activity->subject->commentable->id]) }}">{{ $activity->subject->commentable->title }}</a>
@endif