<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') — Admin | {{ site_name() }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="font-body bg-gray-100 antialiased" x-data="{ sidebarOpen: false }">

<div class="flex h-screen overflow-hidden">

    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-brand-dark transform transition-transform duration-200 ease-in-out lg:relative lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        {{-- Logo --}}
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-700">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                <span class="font-display text-xl text-white tracking-wider">HARRIS CARS</span>
                <span class="text-xs text-brand-primary font-semibold uppercase bg-brand-primary/20 px-2 py-0.5 rounded">Admin</span>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            @php
                $pendingAppointments = \App\Models\Appointment::pending()->count();
                $pendingReviews = \App\Models\Testimonial::pending()->count();
            @endphp

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand-primary text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.appointments.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.appointments.*') ? 'bg-brand-primary text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Appointments
                </span>
                @if($pendingAppointments > 0)
                    <span class="bg-yellow-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingAppointments }}</span>
                @endif
            </a>

            <a href="{{ route('admin.services.index') }}"
               class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-brand-primary text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Services
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-brand-primary text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Categories
            </a>

            <a href="{{ route('admin.testimonials.index') }}"
               class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-brand-primary text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                    Reviews
                </span>
                @if($pendingReviews > 0)
                    <span class="bg-brand-blue text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingReviews }}</span>
                @endif
            </a>

            <a href="{{ route('admin.gallery.index') }}"
               class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-brand-primary text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Gallery
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-brand-primary text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                </svg>
                Settings
            </a>

            <div class="pt-4 mt-4 border-t border-gray-700">
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium text-gray-400 hover:bg-gray-700 hover:text-white transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    View Website
                </a>
            </div>
        </nav>

        {{-- User info at bottom --}}
        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-brand-primary rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-left flex items-center px-3 py-2 text-xs text-gray-400 hover:text-[#003370] hover:bg-gray-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Top Bar --}}
        <header class="bg-white border-b border-gray-200 h-16 flex items-center px-6 justify-between">
            <div class="flex items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center space-x-4">
                @php $pendingCount = \App\Models\Appointment::pending()->count(); @endphp
                @if($pendingCount > 0)
                    <a href="{{ route('admin.appointments.index', ['status' => 'pending']) }}"
                       class="relative p-2 text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">{{ $pendingCount }}</span>
                    </a>
                @endif
                <span class="text-sm text-gray-500">{{ now()->format('l, M j') }}</span>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            {{-- Flash Messages --}}
            @include('partials.flash')

            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')

</body>
</html>
