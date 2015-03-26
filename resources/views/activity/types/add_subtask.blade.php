{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} added a subtask:
@if ($activity->subject->trashed() || $activity->task()->trashed())
    {{ $activity->subject->name }}
@else
    <a href="{{ route('subtask.show', [$activity->project_id, $activity->task()->id, $activity->subject->id]) }}">{{ $activity->subject->name }}</a>
@endif
