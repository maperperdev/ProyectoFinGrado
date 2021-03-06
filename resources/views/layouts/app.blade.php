<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portfolio Digital</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container w-full">

        <nav class="fixed top-0 flex flex-wrap items-center justify-between w-full p-6 overflow-hidden bg-gray-800">

            <div class="flex items-center flex-shrink-0 w-1/5 mr-6 text-white">
                <a class="text-white no-underline hover:text-white hover:no-underline" href="{{ url('/') }}">
                    <span class="pl-2 text-2xl"><i class="em em-grinning"></i>Portfolio</span>
                </a>
            </div>
            <button id="nav-toogle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-content">

                <div class="flex w-4/5 pt-6 lg:flex-row-reverse lg:w-auto lg:pt-0" id="nav-content">
                    <ul class="items-center justify-end flex-1 list-reset lg:flex">

                        @guest
                        <li class="mr-3">
                            <a class="inline-block px-4 py-2 text-white no-underline" href="{{ route('login') }}">Acceder</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="mr-3">
                            <a class="inline-block px-4 py-2 text-white no-underline" href="{{ route('register') }}">Registrarse</a>
                        </li>
                        @endif
                        @else
                        <li class="mr-3">
                            <a id="navbarDropdown" class="inline-block px-4 py-2 text-white no-underline" href="{{ route('home') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                        </li>
                        <li class="mr-3" aria-labelledby="navbarDropdown">
                            <a class="inline-block px-4 py-2 text-white no-underline" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer>
            @yield('footer')
        </footer>

    </div>
    <!-- <script>
        document.getElementById('nav-toggle').onclick = function() {
            document.getElementById("nav-content").classList.toggle("hidden");
        }
    </script> -->

</body>

</html>