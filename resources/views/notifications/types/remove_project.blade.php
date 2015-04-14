<a href="{{ route('profile.show', [$notification->actor->username]) }}">{{ $notification->actor->username }}</a>
removed a project you were assigned to: "{{ $notification->subject->name }}"