<div class="members__body">
    @foreach($task->users as $user)
        <span class="members__member">
            <a href="{{ route('activity.showTask', [$project->id, $task->id, $user->username]) }}">
                {!! $user->profile->present()->avatarHtml('40px') !!}
            </a>
            <span class="member-tooltip member-tooltip--bottom">{{ $user->username }}</span>
        </span>
    @endforeach
</div>
