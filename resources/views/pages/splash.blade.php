<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Divvy</title>

    @include('layouts.partials.favicon')

    @yield('css')
    <link href="/css/all.css" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato|Leckerli+One' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="splash-wrapper">
    <div class="top-bar">
        <div class="top-bar__logo">divvy</div>

        <div class="top-bar__login"><a href="/auth/login">Login</a></div>
    </div>


    <div class="hero">
        <div class="hero__overlay">
                <div class="hero__text-header">Project management simplified</div>
                <div class="hero__subtext">Invite your team - divvy it up - get stuff done.</div>
            <a class="hero__register" href="/auth/register"><span>Sign up</span></a>
        </div>
    </div>

    <section class="splash__section splash-overview">
        <div class="splash-overview__header">
            Communication and Delegation
        </div>

        <div class="splash-overview__text">
            Being a project manager is all about communication and delegation. The role of
            project management software is to simplify these cornerstones. Divvy gives project
            managers the tools they need to easily assign tasks to members, monitor activity,
            and keep track of progress. For team members we think collaboration is the key to
            success. While on a task a member is never more than a click away from starting
            a discussion with their team. By working together, we can accomplish great things.
        </div>
        <img class="splash-overview__image" src="{{ asset('images/browser-shot.png') }}" alt=""/>

    </section>

    <section class="splash__section splash-spotlight">

        <img class="splash-spotlight__tablet-mock" src="{{ asset('images/tablet-mock.png') }}" alt=""/>

        <img class="splash-spotlight__laptop-mock" src="{{ asset('images/laptop-mock.png') }}" alt=""/>

        <img class="splash-spotlight__phone-mock" src="{{ asset('images/phone-mock.png') }}" alt=""/>

        <div class="splash-spotlight__text">
            <div class="splash-spotlight__header">Projects on the go</div>
            Team members on the road? No problem, divvy is designed to work just as well
            on your phone as on your desktop. Never miss out just because you are out of the
            office. Complete a task or participate in a discussion from anywhere. All your actions
            remain perfectly in sync with your team members.
        </div>

    </section>

    <section class="splash__section splash-features">
        <div class="container">

            <div class="splash-features__header">
                Features
            </div>
            <div class="splash-features__rule"></div>

            <div class="splash-features__features">
                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-gears"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Collaboration
                    </div>

                    <div class="splash-features__feature__body">
                        By grouping communications and tasks together divvy makes collaboration easy.
                        Roadblocks are easily overcome when you can reach out to a teammate for help.                    </div>
                </div>

                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-bolt"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Real Time
                    </div>

                    <div class="splash-features__feature__body">
                        Your project is always in sync. When a team member adds a new task everyone
                        will see it instantly, no reload required.  Everything happens in real time.
                    </div>
                </div>

                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-mobile"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Portable
                    </div>

                    <div class="splash-features__feature__body">
                        Designed for all of your devices: desktop, laptop, tablet, or phone -
                        divvy looks and works great on them all. No need to download anything from the app store.
                    </div>
                </div>

                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-bell-o"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Notifications
                    </div>

                    <div class="splash-features__feature__body">
                        Never miss a thing. Divvy’s notification system alerts you to all actions that
                        affect you. Someone comments on your discussion topic? You’ll know it.                    </div>
                </div>

                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-comments-o"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Communication
                    </div>

                    <div class="splash-features__feature__body">
                        Email threads can get messy - leave them behind.
                        Our robust discussion and commenting system makes project communication easy to follow.
                    </div>
                </div>

                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-folder-open-o"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Organization
                    </div>

                    <div class="splash-features__feature__body">
                        Keeping organized just got easier. Divvy automatically tracks all activity
                        within your project. See whats been going on at glance, without the paperwork.
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

</body>
</html>
