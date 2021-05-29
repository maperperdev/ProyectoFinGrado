<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio</title>
    <link href="css/app.css" rel="stylesheet">
</head>

<body class="bg-blue-400">
    <div id="app" class="px-5 mx-auto">
        <header-landing-page>
            @if (Route::has('login'))
            @auth
            <a class="mr-5 hover:text-gray-900" href="{{ url('/home') }}">Portfolio digital</a>
            @else
            <a class="mr-5 hover:text-gray-900" href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a class="mr-5 hover:text-gray-900" href="{{ route('register') }}">Registro</a>
            @endif
            @endauth
        </header-landing-page>

        @endif

        <list-of-assets></list-of-assets>
        <!-- <router-view></router-view>
        <router-link to="/about">About</router-link>
        <router-link to="/">Home</router-link>
        <router-link to="/header-landing-page">LandingPage</router-link> -->
        <my-footer></my-footer>
    </div>

    <script src="../js/app.js"></script>
</body>

</html>