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
            Lorem ipsum dolor sit amet.
        </div>

        <div class="splash-overview__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga, rem reprehenderit. Eaque exercitationem minus pariatur. A accusantium adipisci aspernatur atque blanditiis corporis cum distinctio dolore dolores dolorum ducimus esse eveniet harum inventore iure labore laboriosam minima natus numquam odio omnis, praesentium quia rem repellendus reprehenderit sed similique soluta unde vitae.</div>

        <img class="splash-overview__image" src="{{ asset('images/browser-shot.png') }}" alt=""/>

    </section>

    <section class="splash__section splash-spotlight">

        <img class="splash-spotlight__tablet-mock" src="{{ asset('images/tablet-mock.png') }}" alt=""/>

        <img class="splash-spotlight__laptop-mock" src="{{ asset('images/laptop-mock.png') }}" alt=""/>

        <img class="splash-spotlight__phone-mock" src="{{ asset('images/phone-mock.png') }}" alt=""/>

        <div class="splash-spotlight__text">
            <div class="splash-spotlight__header">Lorem ipsum dolor sit amet.</div>

            Lorem ipsum dolor sit amet, consectetur adipisicing elit. At atque ducimus eaque harum iure, labore odio voluptates. A ad amet cum debitis dicta id illo in ipsa iusto laboriosam necessitatibus non perferendis quisquam rerum, totam unde veritatis voluptatem! Asperiores culpa deleniti exercitationem expedita explicabo illum, maiores molestiae quis suscipit unde.
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
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur deleniti dolores iste natus quas repellat tempora tempore temporibus unde voluptate?
                    </div>
                </div>

                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-bolt"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Real Time
                    </div>

                    <div class="splash-features__feature__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur deleniti dolores iste natus quas repellat tempora tempore temporibus unde voluptate?
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
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur deleniti dolores iste natus quas repellat tempora tempore temporibus unde voluptate?
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
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur deleniti dolores iste natus quas repellat tempora tempore temporibus unde voluptate?
                    </div>
                </div>

                <div class="splash-features__feature">
                    <div class="splash-features__icon">
                        <i class="fa fa-comments-o"></i>
                    </div>

                    <div class="splash-features__feature__header">
                        Communication
                    </div>

                    <div class="splash-features__feature__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur deleniti dolores iste natus quas repellat tempora tempore temporibus unde voluptate?
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
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur deleniti dolores iste natus quas repellat tempora tempore temporibus unde voluptate?
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

</body>
</html>
