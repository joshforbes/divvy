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

    <section class="splash__section">

    </section>


</div>




<script src="/js/all.js"></script>
</body>
</html>
