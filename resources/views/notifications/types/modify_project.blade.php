<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
modified a project:
@if ($notification->subject->trashed())
    {{ $notification->subject->name }}
@else
    <a href="{{ route('project.show', [$notification->project_id]) }}">{{ $notification->subject->name }}</a>
@endif
