<div class="members__body">
    @foreach($task->users as $user)
        <span class="members__member">{!! $user->profile->present()->avatarHtml('40px') !!}</span>
    @endforeach
</div>
