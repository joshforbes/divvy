{{ $notification->created_at->diffForHumans() }} -
<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
removed a task: "{{ $notification->subject->name }}" from the project:
@if ($notification->project->trashed())
    {{ $notification->project->name }}
@else
    <a href="{{ route('project.show', [$notification->project_id]) }}">{{ $notification->project->name }}</a>
@endif

