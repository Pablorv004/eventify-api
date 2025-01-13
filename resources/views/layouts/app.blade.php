<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eventify') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/sass/admin_view_style.scss'])

    <!-- Styles -->
    <style>
        .archivo-black-regular {
            color: #ffffff;
            font-family: "Archivo Black", sans-serif;
        }

        .pt-sans-regular {
            font-family: "PT Sans", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .pt-sans-bold {
            font-family: "PT Sans", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .pt-sans-regular-italic {
            font-family: "PT Sans", sans-serif;
            font-weight: 400;
            font-style: italic;
        }

        .pt-sans-bold-italic {
            font-family: "PT Sans", sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .nav-bar-eventify-gradient {
            background: linear-gradient(180deg, rgba(255, 194, 0, 1) 0%, rgba(250, 124, 31, 1) 0%, rgba(255, 193, 81, 1) 100%);
        }

        body,
        #app {
            margin: 0;
            padding: 0;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        .bounce {
            animation: bounce 2s infinite;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm nav-bar-eventify-gradient sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="archivo-black-regular">EVENTIFY.</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link pt-sans-bold fs-5" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ">
                                    <a class="nav-link pt-sans-bold fs-5"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle pt-sans-bold fs-5" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        {{ __('Home') }}
                                    </a>

                                    @if(Auth::user()->role == 'a')
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            {{ __('Admin Panel') }}
                                        </a>
                                    @endif

                                    @if(Auth::user()->role == 'u')
                                        <a class="dropdown-item" href="{{ route('events.index') }}">
                                            {{ __('Events') }}
                                        </a>
                                    @endif

                                    @if(Auth::user()->role == 'o')
                                        <a class="dropdown-item" href="{{ route('events.index') }}">
                                            {{ __('Organizer Panel') }}
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-0">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>

</html>