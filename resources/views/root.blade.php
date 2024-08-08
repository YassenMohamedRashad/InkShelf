<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300..900&display=swap" rel="stylesheet">
    @spladeHead
    @vite('resources/js/app.js')

    <style>
        .bg-image {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="font-Rubik font-extrabold">
    @splade
</body>

</html>
