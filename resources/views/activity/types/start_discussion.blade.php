{{ $activity->created_at->diffForHumans() }} - {{ $activity->present()->username }} added a discussion:
@if ($activity->subject->trashed() || $activity->task()->trashed() )
    {{ $activity->subject->title }}
@else
    <a href="{{ route('discussion.show', [$activity->project_id, $activity->task()->id, $activity->subject->id]) }}">{{ $activity->subject->title }}</a>
@endif