{{ $notification->created_at->diffForHumans() }} -
<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
added you to the project:
<a href="{{ route('project.show', [$notification->project_id]) }}">{{ $notification->project->name }}</a>