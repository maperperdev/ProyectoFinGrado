<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="css/app.css" rel="stylesheet">
    <script type="text/javascript" src="../js/app.js"></script>
</head>

<body class="bg-gray-400">

    <div id="app">

        <header-landing-page>
            @if (Route::has('login'))

            <div class="top-right links">
                @auth
                <a :class="buttonStyle" href="{{ url('/home') }}">Home</a>
                @else
                <a :class="buttonStyle" href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a :class="buttonStyle" href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
            @endif

        </header-landing-page>

        <example-component></example-component>
        <script type="text/javascript" src="../js/app.js"></script>

    </div>
</body>

</html>