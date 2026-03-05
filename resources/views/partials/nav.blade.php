<nav class="bg-brand-dark shadow-lg relative z-50" x-data="{ mobileOpen: false, servicesOpen: false }">

    {{-- Top info bar --}}
    <div class="bg-brand-primary hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-9 text-xs text-white">
                <div class="flex items-center space-x-6">
                    <a href="tel:{{ format_phone(site_phone()) }}" class="flex items-center hover:text-[#6699cc] transition-colors">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        {{ site_phone() }}
                    </a>
                    <span class="flex items-center">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        {{ site_address() }}
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <span>Mon–Fri: 8:00 AM – 5:00 PM</span>
                    <a href="{{ route('appointments.create') }}" class="bg-white text-brand-primary px-3 py-1 rounded font-semibold hover:bg-[#eff6ff] transition-colors">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main nav --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-brand-primary rounded flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                    </svg>
                </div>
                <div>
                    <span class="font-display text-xl text-white tracking-wider leading-none block">HARRIS CARS</span>
                    <span class="text-xs text-gray-400 leading-none">Service Center</span>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('home') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                    Home
                </a>

                {{-- Services Dropdown --}}
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('services.*') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                        Services
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         class="absolute left-0 top-full mt-1 w-56 bg-white rounded-lg shadow-xl py-2 z-50">
                        <a href="{{ route('services.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#eff6ff] hover:text-brand-primary">
                            All Services
                        </a>
                        <div class="border-t border-gray-100 mt-1 pt-1">
                            @php
                                $navCategories = \App\Models\ServiceCategory::active()->ordered()->limit(6)->get();
                            @endphp
                            @foreach($navCategories as $cat)
                                <a href="{{ route('services.index') }}#{{ $cat->slug }}"
                                   class="block px-4 py-2 text-sm text-gray-600 hover:bg-[#eff6ff] hover:text-brand-primary">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('appointments.create') }}"
                   class="px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('appointments.*') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                    Appointment
                </a>

                <a href="{{ route('specials') }}"
                   class="px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('specials') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                    Specials
                </a>

                <a href="{{ route('testimonials.index') }}"
                   class="px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('testimonials.*') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                    Reviews
                </a>

                <a href="{{ route('vehicles.serviced') }}"
                   class="px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('vehicles.*') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                    Vehicles
                </a>

                <a href="{{ route('about') }}"
                   class="px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('about') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                    About
                </a>

                <a href="{{ route('contact') }}"
                   class="px-4 py-2 text-sm font-medium rounded transition-colors {{ request()->routeIs('contact') ? 'text-brand-primary' : 'text-gray-300 hover:text-white' }}">
                    Contact
                </a>
            </div>

            {{-- CTA + Mobile Toggle --}}
            <div class="flex items-center space-x-3">
                <a href="{{ route('appointments.create') }}"
                   class="hidden lg:inline-flex items-center bg-brand-primary hover:bg-[#003370] text-white px-5 py-2.5 rounded text-sm font-semibold tracking-wide transition-colors">
                    Schedule Now
                </a>

                {{-- Mobile menu toggle --}}
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-gray-300 hover:text-white p-2">
                    <svg class="w-6 h-6" x-show="!mobileOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="w-6 h-6" x-show="mobileOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" x-transition class="lg:hidden bg-gray-900 border-t border-gray-700">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">Home</a>
            <a href="{{ route('services.index') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">Services</a>
            <a href="{{ route('appointments.create') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">Appointment</a>
            <a href="{{ route('specials') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">Specials</a>
            <a href="{{ route('testimonials.index') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">Reviews</a>
            <a href="{{ route('vehicles.serviced') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">Vehicles Serviced</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">About</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-800 rounded">Contact</a>
            <div class="pt-2 border-t border-gray-700">
                <a href="tel:{{ format_phone(site_phone()) }}" class="block px-3 py-2 text-brand-primary font-semibold text-sm">
                    Call: {{ site_phone() }}
                </a>
                <a href="{{ route('appointments.create') }}"
                   class="block mt-2 bg-brand-primary text-white text-center px-4 py-2.5 rounded text-sm font-semibold">
                    Schedule Appointment
                </a>
            </div>
        </div>
    </div>
</nav>
