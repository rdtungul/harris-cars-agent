<footer class="bg-brand-dark text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- About / Brand --}}
            <div class="lg:col-span-1">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-brand-primary rounded flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-display text-xl text-white tracking-wider block">HARRIS CARS</span>
                        <span class="text-xs text-gray-400">Service Center</span>
                    </div>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed mb-4">
                    Premium automotive service in Stallings, NC. ASE certified technicians you can trust for honest, reliable repairs.
                </p>
                {{-- Certifications --}}
                <div class="flex items-center space-x-3 text-xs text-gray-500">
                    <span class="border border-gray-600 px-2 py-1 rounded">ASE Certified</span>
                    <span class="border border-gray-600 px-2 py-1 rounded">NAPA AutoCare</span>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-display text-white text-lg tracking-wider mb-4">QUICK LINKS</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-brand-primary transition-colors">Home</a></li>
                    <li><a href="{{ route('services.index') }}" class="hover:text-brand-primary transition-colors">Our Services</a></li>
                    <li><a href="{{ route('appointments.create') }}" class="hover:text-brand-primary transition-colors">Book Appointment</a></li>
                    <li><a href="{{ route('specials') }}" class="hover:text-brand-primary transition-colors">Current Specials</a></li>
                    <li><a href="{{ route('testimonials.index') }}" class="hover:text-brand-primary transition-colors">Customer Reviews</a></li>
                    <li><a href="{{ route('vehicles.serviced') }}" class="hover:text-brand-primary transition-colors">Vehicles We Service</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-brand-primary transition-colors">Gallery</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-brand-primary transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-brand-primary transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="font-display text-white text-lg tracking-wider mb-4">OUR SERVICES</h4>
                <ul class="space-y-2 text-sm">
                    @php
                        $footerServices = \App\Models\Service::active()->ordered()->limit(8)->get();
                    @endphp
                    @foreach($footerServices as $svc)
                        <li>
                            <a href="{{ route('services.show', $svc->slug) }}" class="hover:text-brand-primary transition-colors">
                                {{ $svc->title }}
                            </a>
                        </li>
                    @endforeach
                    @if($footerServices->isEmpty())
                        <li><a href="{{ route('services.index') }}" class="hover:text-brand-primary transition-colors">Oil Changes</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-brand-primary transition-colors">Brake Service</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-brand-primary transition-colors">Engine Diagnostics</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-brand-primary transition-colors">Transmission Service</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-brand-primary transition-colors">AC Repair</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-brand-primary transition-colors">Tire Services</a></li>
                    @endif
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <h4 class="font-display text-white text-lg tracking-wider mb-4">CONTACT US</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start space-x-3">
                        <svg class="w-4 h-4 text-brand-primary mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span class="text-gray-400">{{ site_address() }}</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-brand-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        <a href="tel:{{ format_phone(site_phone()) }}" class="hover:text-brand-primary transition-colors text-gray-400">
                            {{ site_phone() }}
                        </a>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-4 h-4 text-brand-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <a href="mailto:{{ site_email() }}" class="hover:text-brand-primary transition-colors text-gray-400">
                            {{ site_email() }}
                        </a>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-4 h-4 text-brand-primary mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/>
                        </svg>
                        <div class="text-gray-400 text-xs">
                            <p>Mon–Fri: 8:00 AM – 5:00 PM</p>
                            <p>Saturday–Sunday: Closed</p>
                        </div>
                    </li>
                </ul>

                {{-- Social Links --}}
                <div class="flex items-center space-x-3 mt-5">
                    @if(setting('facebook_url'))
                        <a href="{{ setting('facebook_url') }}" target="_blank" rel="noopener"
                           class="w-8 h-8 bg-gray-700 rounded flex items-center justify-center hover:bg-brand-primary transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                            </svg>
                        </a>
                    @endif
                    @if(setting('yelp_url'))
                        <a href="{{ setting('yelp_url') }}" target="_blank" rel="noopener"
                           class="w-8 h-8 bg-gray-700 rounded flex items-center justify-center hover:bg-brand-primary transition-colors">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15H9V8h2v9zm4-3h-2v-6h2v6z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0 text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} {{ site_name() }}. All rights reserved.</p>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('contact') }}" class="hover:text-gray-300 transition-colors">Privacy Policy</a>
                    <a href="{{ route('contact') }}" class="hover:text-gray-300 transition-colors">Terms of Service</a>
                    <a href="{{ route('login') }}" class="hover:text-gray-300 transition-colors">Admin</a>
                </div>
            </div>
        </div>
    </div>
</footer>
