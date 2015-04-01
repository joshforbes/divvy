<div class="members">
    <div class="members__header">
        <div class="members__title">Project Members</div>
    </div>
    <div class="members__body">
        @foreach($project->users as $user)
            <span class="members__member">{!! $user->profile->present()->avatarHtml('40px') !!}</span>
        @endforeach
    </div>
</div>