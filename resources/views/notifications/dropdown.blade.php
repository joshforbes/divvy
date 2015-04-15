@include('notifications.count')

<div class="notification-dropdown hide">
    <div class="notification-dropdown__header">
        <div class="notification-dropdown__title">
            <a href="{{ route('notification.index', [Auth::user()->username]) }}">Notifications</a>
        </div>
        <button class="notification-dropdown__close"><i class="fa fa-times"></i></button>
    </div>
    <div class="notification-dropdown__notifications-wrapper">
        @foreach($unreadNotifications->take(5) as $notification)
            @include('notifications.dropdown-notification')
        @endforeach
    </div>
    <div class="notification-dropdown__empty">
        @if ($unreadNotifications->count() == 0)
            No new notifications
        @endif
    </div>
    <div class="notification-dropdown__more">
        <a href="{{ route('notification.index', [Auth::user()->username]) }}">See All</a>
    </div>
</div>