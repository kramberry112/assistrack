<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'ASSISTRACK')</title>
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
        <script>
            window.PUSHER_APP_KEY = "{{ env('PUSHER_APP_KEY') }}";
            window.PUSHER_APP_CLUSTER = "{{ env('PUSHER_APP_CLUSTER', 'mt1') }}";
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; min-height: 100vh; margin: 0;">
        @if(request()->is('admin*') || request()->is('admindashboard') || request()->is('student-list') || request()->is('applicants') || request()->is('usermanagement') || request()->routeIs('Admin') || request()->routeIs('student.list') || request()->routeIs('applicants.list') || request()->routeIs('admin.usermanagement'))
            @include('layouts.admin-layout')
        @elseif(request()->is('head*') || request()->routeIs('Head') || request()->routeIs('head.student.list') || request()->routeIs('head.reports') || request()->routeIs('head.reports.list') || request()->routeIs('head.students.show'))
            @include('layouts.head-layout')
        @elseif(request()->is('offices*') || request()->is('offices-*') || request()->routeIs('offices.*') || request()->routeIs('attendance.*') || request()->routeIs('tasks.*'))
            @include('layouts.office-layout')
        @elseif(request()->is('student*') || request()->routeIs('student.dashboard') || request()->routeIs('student.community') || request()->routeIs('student.calendar') || request()->routeIs('student.grades'))
            @include('layouts.student-layout')
        @else
            <main style="min-height: 100vh;">
                @yield('content')
            </main>
        @endif
    </body>
</html>
