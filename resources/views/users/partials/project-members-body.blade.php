<div class="members__body">
    @foreach($project->users as $user)
        <span class="members__member">
            <a href="{{ route('activity.showProject', [$project->id, $user->username]) }}">{!! $user->profile->present()->avatarHtml('40px') !!}</a>
            <span class="member-tooltip member-tooltip--bottom">{{ $user->username }}</span>
        </span>
    @endforeach
</div>
