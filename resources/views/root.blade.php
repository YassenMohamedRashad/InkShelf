<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  dir="{{LaravelLocalization::getCurrentLocale() == "ar" ? 'rtl': 'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('images/logo/inkwell.png')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />

    <style>
        .bg-image {
            background-position: center center;
            background-size: cover;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/js/app.js'])

    @spladeHead
</head>

<body class="font-sans antialiased">

    @splade

</body>

</html>
