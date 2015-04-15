<div class="notification-dropdown__notification">
    <div class="notification-dropdown__actor-avatar">
        {!! $notification->actor->profile->present()->avatarHtml('50px') !!}
    </div>
    <div class="notification-dropdown__body">
        @include("notifications.types.{$notification->action}")
        <div class="notification-dropdown__timestamp">
            {{ $notification->created_at->diffForHumans() }}
        </div>
    </div>
</div>