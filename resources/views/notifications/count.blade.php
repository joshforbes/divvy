<div class="notification-nav__count-wrapper">
    @if ($unreadNotifications->count() > 0)

        <span class="notification-nav__count">{{ $unreadNotifications->count() }}</span>

    @endif
</div>
