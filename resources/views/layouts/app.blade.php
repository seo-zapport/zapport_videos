<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="zp-video-admin sticky-menu">
        @auth
            <div id="zp_nav" role="navigation">
                <a href="#zp-content" class="sr-only">Skip to main content</a>
                <a href="#zp-toolbar" class="sr-only">Skip to toolbar</a>
                @include('layouts.sidebar')
            </div>
            <div id="zp_content_wrap">
                @include('layouts.top')
                <main class="zp-primary-site" role="main">
                    <div class="zp-primary-wrap">
                        <h2 class="heading-title">
                            @yield('heading')
                        </h2>
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </main>
            </div>
        @else
            @yield('content')
        @endauth
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
