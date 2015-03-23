{{ $notification->created_at->diffForHumans() }} -
<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
removed you from the project: "{{ $notification->project->name }}"