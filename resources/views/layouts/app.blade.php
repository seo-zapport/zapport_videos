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
<<<<<<< HEAD
            <div id="zp_content_wrap">
                @include('layouts.top')
                <main class="zp-primary-site" role="main">
                    <div class="zp-primary-wrap">
                        <div class="container-fluid">
                            @yield('content')
=======
        </nav>
        <main class="py-4">
            @auth
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    <ul class="list-group">
                        @if (Gate::check('isSuperAdmin') || Gate::check('isAdmin'))
                        <li class="list-group-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li class="list-group-item"><a href="{{ route('media.create') }}">Add Media</a></li>
                        <li class="list-group-item"><a href="{{ route('media.index') }}">Media</a></li>
                        <li class="list-group-item"><a href="{{ route('category.index') }}">Category</a></li>
                        @endif
                        @if (Gate::check('isSuperAdmin'))
                        <li class="list-group-item"><a href="{{ route('register') }}">Register User</a></li>
                        <li class="list-group-item"><a href="{{ route('admin.index') }}">Users</a></li>
                        <li class="list-group-item"><a href="{{ route('role.index') }}">Roles</a></li>
                      @endif
                    </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Dashboard</div>

                            <div class="card-body">
                                @yield('content')

                            </div>
>>>>>>> 37ff1592a2b6291e92b1d5ba4dce7a7377dce00e
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
