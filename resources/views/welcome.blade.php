<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>{{config('app.name')}}</title>
    <meta name="theme-color" content="#563d7c">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="/css/cover.css">
</head>
<body class="text-center" style="background-image: url('/images/blog.svg'); background-repeat: no-repeat; background-position: left center;">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                {{--
                <nav class="nav nav-masthead justify-content-center">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('home') }}" class="nav-link">{{ __('Go Home')}}</a>
                    @else
                    <a href="{{ route('login') }}" class="nav-link">{{__('Login')}}</a>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="nav-link">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                    @endauth
                    @endif
                </nav>
                --}}
            </div>
        </header>

        <main role="main" class="inner cover my-auto">
            <h1 class="cover-heading">{{config('app.name')}}</h1>
            <p class="lead">
                {{config('app.description')}}
            </p>
            <p class="lead">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('home') }}" class="btn btn-lg btn-secondary">{{ __('Go Home')}}</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-lg btn-secondary">{{__('Login')}}</a>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                @endauth
                @endif
            </p>
        </main>
        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>
                    Ministerio de Economía
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
