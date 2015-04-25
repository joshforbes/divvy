modified a subtask:
@if ( $activity->subject->trashed() )
    {{ $activity->subject->name }}
@else
    <a href="{{ route('subtask.show', [$activity->project_id, $activity->subject->task->id, $activity->subject->id]) }}">{{ $activity->subject->name }}</a>
@endif