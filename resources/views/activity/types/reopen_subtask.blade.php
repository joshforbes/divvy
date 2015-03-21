{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} re-opened a subtask:
@if ($activity->subject->trashed())
    {{ $activity->subject->name }}
@else
    <a href="{{ route('subtask.show', [$activity->subject->task->project_id, $activity->subject->task->id, $activity->subject->id]) }}">{{ $activity->subject->name }}</a>
@endif