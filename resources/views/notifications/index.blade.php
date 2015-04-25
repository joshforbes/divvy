@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">Notifications</h3>
        </div>
    </div>

    <div class="notification-wrapper">
        <div class="notifications">
            <div class="notifications__header">
                <div class="notifications__title">Your Notifications</div>
            </div>
            <div class="notifications__body">
                @if($notifications->count() == 0)
                    <p class="notifications__none">
                        You have no notifications
                    </p>
                @endif
                @foreach($notifications as $notification)
                    <div class="notification">
                        <div class="notification__actor-avatar">
                            {!! $notification->actor->profile->present()->avatarHtml('40px') !!}
                        </div>

                        <div class="notification__info">
                            @include("notifications.types.{$notification->action}")
                            <div class="notification__timestamp">
                                {{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="notifications__pagination">
                {!! $notifications->render() !!}
            </div>
        </div>
    </div>

@endsection