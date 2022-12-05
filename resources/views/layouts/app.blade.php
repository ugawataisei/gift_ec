<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/11bead58f7.js" crossorigin="anonymous"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @if(Auth::guard('admin')->user())
        @include('layouts.admin-navigation')
    @elseif(Auth::guard('owners')->user())
        @include('layouts.owner-navigation')
    @else
        @include('layouts.user-navigation')
    @endif

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</html>
