modified a discussion:
@if ( $activity->subject->trashed() )
    {{ $activity->subject->title }}
@else
    <a href="{{ route('discussion.show', [$activity->project_id, $activity->subject->task->id, $activity->subject->id]) }}">{{ $activity->subject->title }}</a>
@endif