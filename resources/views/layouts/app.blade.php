<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Luxury Hotel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    <!-- Hero Section with Background Image -->
    <div class="relative min-h-screen">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/background-image.jpeg') }}"
                 alt="Luxury Hotel"
                 class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        @include('partials.navigation')

        <!-- Main Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-16 pb-20">
            @yield('content')
        </div>
    </div>

    @include('partials.footer')
</body>
</html> 