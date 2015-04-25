completed a task:
@if ($activity->subject->trashed())
    {{ $activity->subject->name }}
@else
    <a href="{{ route('task.show', [$activity->project_id, $activity->subject->id]) }}">{{ $activity->subject->name }}</a>
@endif