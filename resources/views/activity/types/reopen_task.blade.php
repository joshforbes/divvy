{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} re-opened a task:
@if ( $activity->subject->trashed() )
    {{ $activity->subject->name }}
@else
    <a href="{{ route('task.show', [$activity->subject->project_id, $activity->subject->id]) }}">{{ $activity->subject->name }}</a>
@endif