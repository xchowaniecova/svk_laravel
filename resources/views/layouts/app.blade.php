<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ŠVK') }}</title>
    

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            .card-box {
                position: relative;
                color: #fff;
                padding: 20px 10px 20px;
                margin: 1% 10%;
                text-align: center;
            } 
            .card-box .inner {
                padding: 5px 10px 0 10px;
            }
            .bg-blue {
                /* background-color: #74b6c0; */
                background-color: #c9d6e6;
            }
            .bg-navbar {
                /* background-color: #264653; */
                background-color: #4b6187;
            }
            .bg-second-navbar {
                background-color: #63A7C3;
            }
            .text-navbar {
                /* color: #264653; */
                color: #334564;
                font-weight: bold;
            }
        </style> 
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-navbar shadow-sm">
                <div class="container">
                    <a class="navbar-brand text-white" href="{{ url('/') }}">
                        {{ config('app.name', 'ŠVK') }}
                    </a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                     

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('header.login') }}</a>
                                    </li>
                                @endif
              
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="{{ route('register') }}">{{ __('header.register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
              
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item text-navbar" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('header.logout') }}
                                        </a>
              
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        <a class="dropdown-item text-navbar" href="{{route('change-password')}}">Zmena hesla</a>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
    
</html>
