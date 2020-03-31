<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Southwood AdminSuite</title>

    <meta name="author" content="Jeppe Vinkel Beier">
    <meta name="description" content="Admin suite for SCP:SL servers running the EXILED plugin loader.">
    <meta name="keywords" content="scp,sl,exiled,southwood">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body class="bg-gray-900 font-sans leading-normal tracking-normal mt-12">

@include('layouts.dashboard.partials.header')


@yield('content')

</body>
</html>
