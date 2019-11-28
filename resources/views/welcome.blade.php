<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zapport Video</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <style type="text/css">
        .zp-front{
            background: url('images/bg-hero.jpg') no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            width: 100vh;
            position: relative;
        }
        .zp-smoke{
            position: relative;
        }
        .zp-smoke:before{
            content: '';
            background-color: rgba(0, 0, 0, 0.65);
            display: block;
            position: absolute;
            height: 100vh;
            width: 100vw;
            left:0;
            right: 0;
            margin: auto;
        }
        .zp-logo-wrap{
            position: absolute;
            z-index: 5;
            text-align: center;
            left: 0;
            right: 0;
            width: 100vw;
            top: 20%;
        }
        .z-index-1{
            position: relative;
            z-index: 1;
        }
        .btn-custom-trans {
            background-color: transparent;
            border-color: #fff;
            color: #fff;
            padding: 0.75rem 3.5rem;
            font-size: 1.125rem;
            line-height: 1.5;
            border-radius: 0.3rem;
            transition: all ease-in-out 0.5s;
        }

        .btn-custom-trans a {
            text-transform: uppercase;
            color: #fff;
            line-height: 1.5;
        }

        .btn-custom-trans:hover {
            background-color: #0acfd4;
            color: #fff;
            border-color: #0acfd4;
        }

        .btn-custom-trans:hover a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body class="zp-front">
    <div class="zp-smoke"></div>
    <section class="zp-logo-wrap">
        <div class="container">
            <img src="{{ asset('images/zapport logo.png') }}" class="mb-5">  
            <div class="pt-5">
                <a href="{{ route('login') }}" class="btn btn-custom-trans">Login</a>   
            </div>
        </div>
    </section>
</body>
</html>