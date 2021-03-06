<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Lato|Leckerli+One' rel='stylesheet' type='text/css'>

    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Leckerli One';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 20px;
        }

        a {
            font-family: 'Lato';
            font-size: 21px;
            color: inherit;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">not authorized.</div>
        <a href="{{ URL::previous() }}">Go Back</a>
    </div>
</div>
</body>
</html>
