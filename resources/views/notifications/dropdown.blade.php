@if ($unreadNotifications->count() > 0)
    <span class="notification-nav__count">{{ $unreadNotifications->count() }}</span>
@endif
<div class="notification-dropdown hide">
    <div class="notification-dropdown__header">
        <div class="notification-dropdown__title">
            <a href="{{ route('notification.index', [Auth::user()->username]) }}">Notifications</a>
        </div>
        <button class="notification-dropdown__close"><i class="fa fa-times"></i></button>
    </div>
    @if($unreadNotifications->count() > 0)
        @foreach($unreadNotifications->take(5) as $notification)
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
        @endforeach
    @else
        <div class="notification-dropdown__notification">
            <div class="notification-dropdown__body">
                No new notifications
            </div>
        </div>
    @endif
    <div class="notification-dropdown__more">
        <a href="{{ route('notification.index', [Auth::user()->username]) }}">See All</a>
    </div>

</div>