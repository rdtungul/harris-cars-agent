@extends('layouts.app')

@section('title', 'Premium Auto Service in Stallings, NC')
@section('meta_description', 'Harris Cars Service Center — ASE Certified auto repair and maintenance in Stallings, NC. Oil changes, brake service, engine diagnostics, AC repair & more. Call (704) 234-8351.')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="relative bg-brand-dark overflow-hidden min-h-[620px] flex items-center">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;><g fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;><g fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.1&quot;><circle cx=&quot;30&quot; cy=&quot;30&quot; r=&quot;2&quot;/></g></g></svg>');"></div>
    </div>
    {{-- Red accent bar --}}
    <div class="absolute left-0 top-0 bottom-0 w-1 bg-brand-primary"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center bg-brand-primary/20 border border-brand-primary/40 px-4 py-1.5 rounded-full mb-6">
                    <span class="w-2 h-2 bg-brand-primary rounded-full mr-2 animate-pulse"></span>
                    <span class="text-brand-primary text-sm font-semibold tracking-wide">ASE Certified Technicians</span>
                </div>

                <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl text-white tracking-wider leading-none mb-6">
                    YOUR CAR<br>
                    <span class="text-brand-primary">DESERVES</span><br>
                    THE BEST
                </h1>

                <p class="text-gray-300 text-lg leading-relaxed mb-8 max-w-lg">
                    Premium automotive service in Stallings, NC. Honest pricing, certified technicians, and reliable repairs for all domestic and foreign vehicles.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('appointments.create') }}"
                       class="inline-flex items-center justify-center bg-brand-primary hover:bg-[#003370] text-white px-8 py-4 font-display text-xl tracking-wider transition-colors">
                        SCHEDULE SERVICE
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="tel:{{ format_phone(site_phone()) }}"
                       class="inline-flex items-center justify-center border-2 border-gray-500 hover:border-white text-white px-8 py-4 font-semibold transition-colors">
                        <svg class="mr-2 w-5 h-5 text-brand-primary" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        {{ site_phone() }}
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-800/60 border border-gray-700 p-6 rounded-lg text-center">
                    <div class="font-display text-4xl text-brand-primary tracking-wider">{{ $stats['years_experience'] }}</div>
                    <div class="text-gray-400 text-sm mt-1">Years Experience</div>
                </div>
                <div class="bg-gray-800/60 border border-gray-700 p-6 rounded-lg text-center">
                    <div class="font-display text-4xl text-brand-primary tracking-wider">{{ $stats['vehicles_serviced'] }}</div>
                    <div class="text-gray-400 text-sm mt-1">Vehicles Serviced</div>
                </div>
                <div class="bg-gray-800/60 border border-gray-700 p-6 rounded-lg text-center">
                    <div class="font-display text-4xl text-brand-primary tracking-wider">4.9★</div>
                    <div class="text-gray-400 text-sm mt-1">Average Rating</div>
                </div>
                <div class="bg-gray-800/60 border border-gray-700 p-6 rounded-lg text-center">
                    <div class="font-display text-4xl text-brand-primary tracking-wider">100%</div>
                    <div class="text-gray-400 text-sm mt-1">Satisfaction Goal</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== QUICK SERVICES BAR ===== --}}
<section class="bg-brand-primary py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-x-8 gap-y-2 text-white text-sm font-semibold">
            <span>Oil Changes</span>
            <span class="hidden sm:block opacity-50">|</span>
            <span>Brake Service</span>
            <span class="hidden sm:block opacity-50">|</span>
            <span>Engine Diagnostics</span>
            <span class="hidden sm:block opacity-50">|</span>
            <span>AC Repair</span>
            <span class="hidden sm:block opacity-50">|</span>
            <span>Transmission</span>
            <span class="hidden sm:block opacity-50">|</span>
            <span>Tire Services</span>
            <span class="hidden sm:block opacity-50">|</span>
            <span>Suspension</span>
        </div>
    </div>
</section>

{{-- ===== FEATURED SERVICES ===== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="text-brand-primary font-semibold uppercase tracking-widest text-sm mb-2">What We Do</p>
            <h2 class="font-display text-5xl text-brand-dark tracking-wider mb-4">OUR SERVICES</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Complete automotive care from routine maintenance to major repairs — all under one roof with expert technicians.</p>
        </div>

        @if($featuredServices->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredServices as $service)
                    <a href="{{ route('services.show', $service->slug) }}"
                       class="group border border-gray-200 hover:border-brand-primary rounded-lg overflow-hidden transition-all duration-200 hover:shadow-lg">
                        <div class="border-l-4 border-brand-primary p-6">
                            <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center mb-4 group-hover:bg-brand-primary transition-colors">
                                <svg class="w-6 h-6 text-brand-primary group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-display text-xl text-brand-dark tracking-wide mb-2 group-hover:text-brand-primary transition-colors">
                                {{ strtoupper($service->title) }}
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-3">
                                {{ $service->short_description_truncated }}
                            </p>
                            @if($service->price_range)
                                <p class="text-brand-primary font-semibold text-sm">{{ $service->price_range }}</p>
                            @endif
                            <span class="inline-flex items-center text-sm text-brand-primary font-medium mt-3 group-hover:translate-x-1 transition-transform">
                                Learn More
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            {{-- Fallback services if DB is empty --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                    ['title' => 'Oil Change Service', 'desc' => 'Full synthetic, conventional, or high-mileage oil changes with multi-point inspection.'],
                    ['title' => 'Brake Repair', 'desc' => 'Complete brake system inspection, pad replacement, rotor resurfacing, and fluid service.'],
                    ['title' => 'Engine Diagnostics', 'desc' => 'Advanced computer diagnostics to identify and resolve engine issues quickly.'],
                    ['title' => 'AC & Heating Repair', 'desc' => 'Full HVAC system diagnosis, recharge, and repair to keep you comfortable year-round.'],
                    ['title' => 'Transmission Service', 'desc' => 'Fluid flush, filter replacement, and complete transmission repair and rebuild services.'],
                    ['title' => 'Tire & Wheel Service', 'desc' => 'Tire rotation, balancing, alignment, and new tire installation for all makes and models.'],
                ] as $svc)
                    <div class="border border-gray-200 hover:border-brand-primary rounded-lg overflow-hidden transition-all duration-200 hover:shadow-lg border-l-4">
                        <div class="border-l-4 border-brand-primary p-6">
                            <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                </svg>
                            </div>
                            <h3 class="font-display text-xl text-brand-dark tracking-wide mb-2">{{ strtoupper($svc['title']) }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $svc['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-10">
            <a href="{{ route('services.index') }}"
               class="inline-flex items-center bg-brand-dark hover:bg-gray-800 text-white px-8 py-4 font-display text-lg tracking-wider transition-colors">
                VIEW ALL SERVICES
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- ===== WHY CHOOSE US ===== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-brand-primary font-semibold uppercase tracking-widest text-sm mb-2">Why Harris Cars</p>
                <h2 class="font-display text-5xl text-brand-dark tracking-wider mb-6">THE HARRIS<br><span class="text-brand-primary">DIFFERENCE</span></h2>
                <p class="text-gray-500 leading-relaxed mb-8">
                    We treat every vehicle like it belongs to family. No upselling, no unnecessary repairs — just honest, expert service from technicians who care about getting it right.
                </p>
                <a href="{{ route('about') }}" class="inline-flex items-center text-brand-primary font-semibold hover:text-[#003370] transition-colors">
                    Learn More About Us
                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach([
                    ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => 'ASE Certified', 'desc' => 'Our technicians hold current ASE certifications across all service areas.'],
                    ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Honest Pricing', 'desc' => 'Upfront estimates with no hidden fees. We explain every charge before work begins.'],
                    ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Fast Turnaround', 'desc' => 'We respect your time with efficient service and accurate completion estimates.'],
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Warranty Backed', 'desc' => 'Most repairs include a parts and labor warranty for your peace of mind.'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Expert Team', 'desc' => 'Decades of combined experience on all domestic and foreign vehicles.'],
                    ['icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'title' => 'Comfortable Shop', 'desc' => 'Free WiFi, refreshments, and a welcoming waiting area while you wait.'],
                ] as $feature)
                    <div class="bg-white border border-gray-200 p-5 rounded-lg flex items-start space-x-4 hover:border-brand-primary transition-colors group">
                        <div class="w-10 h-10 bg-red-50 group-hover:bg-brand-primary rounded-lg flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-5 h-5 text-brand-primary group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-brand-dark text-sm mb-1">{{ $feature['title'] }}</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===== CTA BANNER ===== --}}
<section class="bg-brand-primary py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <div>
                <h2 class="font-display text-4xl sm:text-5xl text-white tracking-wider mb-2">
                    READY TO SCHEDULE?
                </h2>
                <p class="text-red-100 text-lg">We're ready to get your vehicle running at its best.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 flex-shrink-0">
                <a href="tel:{{ format_phone(site_phone()) }}"
                   class="inline-flex items-center justify-center bg-white text-brand-primary px-8 py-4 font-display text-xl tracking-wider hover:bg-[#eff6ff] transition-colors">
                    <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                    {{ site_phone() }}
                </a>
                <a href="{{ route('appointments.create') }}"
                   class="inline-flex items-center justify-center border-2 border-white text-white px-8 py-4 font-display text-xl tracking-wider hover:bg-white hover:text-brand-primary transition-colors">
                    BOOK ONLINE
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===== SPECIALS ===== --}}
@if($activeSpecials->isNotEmpty())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-brand-primary font-semibold uppercase tracking-widest text-sm mb-2">Save Money</p>
            <h2 class="font-display text-5xl text-brand-dark tracking-wider">CURRENT SPECIALS</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($activeSpecials as $special)
                <div class="relative border-2 border-brand-primary rounded-lg overflow-hidden">
                    @if($special->discount_text)
                        <div class="absolute top-4 right-4 bg-brand-primary text-white font-display text-xl px-3 py-1 tracking-wider">
                            {{ $special->discount_text }}
                        </div>
                    @endif
                    <div class="p-6 pt-14">
                        <h3 class="font-display text-2xl text-brand-dark tracking-wide mb-2">{{ strtoupper($special->title) }}</h3>
                        <p class="text-gray-500 text-sm mb-4">{{ $special->description }}</p>
                        @if($special->sale_price)
                            <div class="flex items-baseline gap-2 mb-3">
                                @if($special->original_price)
                                    <span class="text-gray-400 line-through text-sm">{{ $special->original_price }}</span>
                                @endif
                                <span class="text-brand-primary font-bold text-2xl">{{ $special->sale_price }}</span>
                            </div>
                        @endif
                        @if($special->valid_until)
                            <p class="text-xs text-gray-400 mb-4">Expires {{ $special->valid_until->format('M j, Y') }}</p>
                        @endif
                        <a href="{{ route('appointments.create') }}"
                           class="inline-block bg-brand-primary text-white px-5 py-2 text-sm font-semibold hover:bg-[#003370] transition-colors">
                            Claim This Deal
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('specials') }}" class="text-brand-primary font-semibold hover:text-[#003370] transition-colors">
                View All Specials &rarr;
            </a>
        </div>
    </div>
</section>
@endif

{{-- ===== TESTIMONIALS ===== --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="text-brand-primary font-semibold uppercase tracking-widest text-sm mb-2">Happy Customers</p>
            <h2 class="font-display text-5xl text-brand-dark tracking-wider mb-2">WHAT THEY SAY</h2>
            <div class="flex items-center justify-center gap-1 mt-2">
                <span class="text-yellow-500 text-xl">★★★★★</span>
                <span class="text-gray-600 font-semibold ml-2">4.9 / 5.0</span>
                <span class="text-gray-400 text-sm ml-1">avg. rating</span>
            </div>
        </div>

        @if($featuredTestimonials->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($featuredTestimonials as $review)
                    <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-brand-primary transition-colors relative">
                        {{-- Quote mark --}}
                        <div class="absolute top-4 right-5 text-gray-100 font-display text-6xl leading-none select-none">"</div>
                        <div class="flex items-center mb-1">
                            <span class="text-yellow-500 text-lg">
                                @for($i = 0; $i < $review->rating; $i++)★@endfor
                                @for($i = $review->rating; $i < 5; $i++)☆@endfor
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-5 italic relative z-10">
                            "{{ $review->review_excerpt }}"
                        </p>
                        <div class="flex items-center space-x-3 border-t border-gray-100 pt-4">
                            <div class="w-10 h-10 bg-brand-primary rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ $review->initials }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-brand-dark text-sm">{{ $review->customer_name }}</p>
                                @if($review->customer_location)
                                    <p class="text-gray-400 text-xs">{{ $review->customer_location }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Placeholder testimonials --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['name' => 'Michael T.', 'location' => 'Stallings, NC', 'stars' => 5, 'review' => 'Harris Cars has been my go-to shop for years. Honest, fair pricing and they always explain what needs to be done without pressuring you. My whole family uses them now.'],
                    ['name' => 'Sarah W.', 'location' => 'Waxhaw, NC', 'stars' => 5, 'review' => 'Brought my car in for brake issues. They diagnosed it quickly, gave me a fair quote, and had it done same day. The waiting area is clean and comfortable too. Highly recommend!'],
                    ['name' => 'James P.', 'location' => 'Indian Trail, NC', 'stars' => 5, 'review' => 'Best mechanic shop I have ever been to. The team is knowledgeable, professional, and genuinely cares about doing the job right. I would not take my vehicles anywhere else.'],
                ] as $review)
                    <div class="bg-white rounded-lg p-6 border border-gray-200 hover:border-brand-primary transition-colors relative">
                        <div class="absolute top-4 right-5 text-gray-100 font-display text-6xl leading-none select-none">"</div>
                        <div class="flex items-center mb-1">
                            <span class="text-yellow-500 text-lg">{{ str_repeat('★', $review['stars']) }}</span>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-5 italic relative z-10">"{{ $review['review'] }}"</p>
                        <div class="flex items-center space-x-3 border-t border-gray-100 pt-4">
                            <div class="w-10 h-10 bg-brand-primary rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ substr($review['name'], 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-brand-dark text-sm">{{ $review['name'] }}</p>
                                <p class="text-gray-400 text-xs">{{ $review['location'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="text-center mt-10">
            <a href="{{ route('testimonials.index') }}" class="text-brand-primary font-semibold hover:text-[#003370] transition-colors">
                Read All Reviews &rarr;
            </a>
        </div>
    </div>
</section>

{{-- ===== AMENITIES BAR ===== --}}
<section class="bg-brand-dark py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            @foreach([
                ['icon' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0', 'label' => 'Free WiFi'],
                ['icon' => 'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4m0 0h18', 'label' => 'Refreshments'],
                ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'label' => 'Comfortable Waiting Area'],
                ['icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z', 'label' => 'Key Drop-Off Service'],
            ] as $amenity)
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-12 h-12 border-2 border-brand-primary rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $amenity['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="text-gray-300 text-sm font-medium">{{ $amenity['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== MAP ===== --}}
<section class="h-96">
    @php $mapEmbed = setting('google_maps_embed_url', env('GOOGLE_MAPS_EMBED_URL', '')); @endphp
    @if($mapEmbed)
        <iframe
            src="{{ $mapEmbed }}"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Harris Cars Service Center Location">
        </iframe>
    @else
        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
            <div class="text-center">
                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-gray-500 font-medium">2023 Richard Baker Dr, Stallings, NC 28104</p>
                <a href="https://maps.google.com/?q=2023+Richard+Baker+Dr+Stallings+NC+28104" target="_blank"
                   class="text-brand-primary text-sm hover:underline mt-1 inline-block">
                    Get Directions &rarr;
                </a>
            </div>
        </div>
    @endif
</section>

@endsection
