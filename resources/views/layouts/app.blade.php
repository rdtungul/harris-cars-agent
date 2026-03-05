<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Auto Repair & Service') | {{ site_name() }}</title>
    <meta name="description" content="@yield('meta_description', setting('meta_description', 'Harris Cars Service Center — Premium automotive service in Stallings, NC. ASE Certified technicians, honest pricing, and reliable repairs for all domestic and foreign vehicles.'))">
    <meta name="keywords" content="@yield('meta_keywords', 'auto repair, car service, oil change, brake repair, Stallings NC, Charlotte NC, ASE certified')">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', site_name())">
    <meta property="og:description" content="@yield('meta_description', setting('meta_description', 'Premium automotive service in Stallings, NC.'))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Barlow+Condensed:wght@600;700&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-body bg-white text-gray-900 antialiased">

    {{-- Navigation --}}
    @include('partials.nav')

    {{-- Flash Messages --}}
    @include('partials.flash')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    @stack('scripts')

</body>
</html>
