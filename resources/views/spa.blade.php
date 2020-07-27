<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <div id="app">

        @include('partials.header')

        <div class="flex-center position-ref full-height">
            @if (Route::has(app()->getLocale().'.auth.login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('backend') }}">{{ __('Backend') }}</a>
                    @else
                        <a href="{{ route(app()->getLocale().'.auth.login') }}">{{ __('Login') }}</a>

                        @if (Route::has(app()->getLocale().'.auth.register'))
                            <a href="{{ route(app()->getLocale().'.auth.register') }}">{{ __('Register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                <transition name="slide-fade" mode="out-in">
                    <router-view :key="$route.fullPath"></router-view>
                </transition>

                <navbar></navbar>

            </div>
        </div>

        @include('partials.footer')

    </div>
    </body>
</html>
