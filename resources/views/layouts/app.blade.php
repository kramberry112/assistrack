<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Universidad de Dagupan')</title>
        <link rel="stylesheet" href="/css/app.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; min-height: 100vh; margin: 0;">
        <main style="min-height: 100vh;">
            @yield('content')
        </main>
    </body>
</html>
