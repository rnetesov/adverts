<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Advert')</title>

    <script defer src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://kit.fontawesome.com/c429421d62.js" crossorigin="anonymous"></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('styles', '')
</head>
<body>

@include('layouts.partials.nav')

<div class="container">
    @include('flash::message')
    @yield('breadcrumbs', Breadcrumbs::render() )
    @yield('content')
</div>
    @yield('scripts', '')
</body>
</html>
