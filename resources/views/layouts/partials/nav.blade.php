<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <ul class="navbar__collapsed">
                @if (Auth::guest())
                    <li><a href="/auth/login">Login</a></li>
                    <li><a href="/auth/register">Register</a></li>
                @else
                <li>
                    <a class="navbar__projects-link" href=" {{ route('home') }}"><i class="fa fa-home"></i></a>
                </li>
                <li class="notification-nav">
                    <a href="{{ route('notification.markAsRead', [Auth::user()->username]) }}" class="notification-nav__link"><i class="fa fa-bell"></i></a>
                    @include('notifications.count')
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="navbar__avatar">
                            {!! Auth::user()->profile->present()->avatarHtml('30px') !!}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li><a href="{{ route('profile.show', Auth::user()->username )}}">Profile</a></li>
                        <li><a href="/auth/logout">Logout</a></li>
                    </ul>
                </li>

                @endif
            </ul>

            <a class="navbar-brand" href="/">divvy</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if (Auth::user())
                <li>
                    <a class="navbar__projects-link" href=" {{ route('home') }}"><i class="fa fa-home"></i>Projects</a>
                </li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="/auth/login">Login</a></li>
                    <li><a href="/auth/register">Register</a></li>
                @else
                    <li class="notification-nav">
                        <a href="{{ route('notification.markAsRead', [Auth::user()->username]) }}" class="notification-nav__link"><i class="fa fa-bell"></i></a>
                        @include('notifications.count')
                        {{--@include('notifications.dropdown')--}}
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="navbar__avatar">{!! Auth::user()->profile->present()->avatarHtml('30px') !!}</span>
                            {{ Auth::user()->username }} <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li><a href="{{ route('profile.show', Auth::user()->username )}}">Profile</a></li>
                            <li><a href="/auth/logout">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    @if (Auth::user())
        @include('notifications.dropdown')
    @endif
</nav>

