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
    <body style="font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc;">
        <header style="background:#23408e;color:#fff;padding:18px 0;text-align:center;">
            <img src="/images/uddlogo.png" alt="UDD Logo" style="height:48px;vertical-align:middle;margin-right:12px;">
            <span style="font-size:28px;font-weight:bold;vertical-align:middle;">UNIVERSIDAD DE DAGUPAN</span>
            <nav style="margin-top:12px;">
                <a href="/welcome" style="color:#fff;margin:0 18px;text-decoration:none;font-weight:bold;">Home</a>
                <a href="/index" style="color:#fff;margin:0 18px;text-decoration:none;font-weight:bold;">About</a>
                <a href="/achievements" style="color:#fff;margin:0 18px;text-decoration:none;font-weight:bold;">Achievements</a>
                <a href="/events" style="color:#fff;margin:0 18px;text-decoration:none;font-weight:bold;">Events</a>
                <a href="/apply" style="color:#fff;margin:0 18px;text-decoration:none;font-weight:bold;">Apply</a>
                <a href="/login" style="color:#fff;margin:0 18px;text-decoration:none;font-weight:bold;">Login</a>
            </nav>
        </header>
        <main style="min-height:70vh;">
            @yield('content')
        </main>
        <footer style="background:#23408e;color:#fff;text-align:center;padding:18px 0;margin-top:32px;">
            &copy; 2023 - 2025 Universidad de Dagupan. All rights reserved.
        </footer>
    </body>
</html>
