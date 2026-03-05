@extends('layouts.app')

@section('title', 'About Harris Cars Service Center')
@section('meta_description', 'Learn about Harris Cars Service Center in Stallings, NC. ASE Certified mechanics, family-owned, serving the greater Charlotte area with honest auto repair since day one.')

@section('content')

<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">ABOUT US</h1>
        <p class="text-gray-400 max-w-xl mx-auto">Your trusted auto service partner in Stallings, NC since we opened our doors.</p>
    </div>
</div>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <p class="text-brand-primary font-semibold uppercase tracking-widest text-sm mb-2">Our Story</p>
                <h2 class="font-display text-5xl text-brand-dark tracking-wider mb-6">BUILT ON<br><span class="text-brand-primary">TRUST</span></h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Harris Cars Service Center was founded with a simple mission: to provide the greater Stallings and Charlotte area with honest, high-quality automotive service at fair prices. We believe that car repair doesn't have to be stressful or confusing.
                </p>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Our team of ASE Certified technicians brings decades of combined experience working on all makes and models — both domestic and foreign. We invest in the latest diagnostic equipment and ongoing training so we can provide you with accurate diagnoses and reliable repairs.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    When you bring your vehicle to Harris Cars, we treat it like our own. We'll explain what's wrong, what it will cost to fix it, and why — before we ever touch a wrench. No surprises. No upsells. Just honest service.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <div class="font-display text-5xl text-brand-primary mb-2">15+</div>
                    <div class="text-gray-600 text-sm">Years of Experience</div>
                </div>
                <div class="bg-brand-dark rounded-lg p-6 text-center">
                    <div class="font-display text-5xl text-brand-primary mb-2">10k+</div>
                    <div class="text-gray-300 text-sm">Vehicles Serviced</div>
                </div>
                <div class="bg-brand-primary rounded-lg p-6 text-center">
                    <div class="font-display text-5xl text-white mb-2">4.9</div>
                    <div class="text-red-100 text-sm">Star Rating</div>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                    <div class="font-display text-5xl text-brand-primary mb-2">ASE</div>
                    <div class="text-gray-600 text-sm">Certified Shop</div>
                </div>
            </div>
        </div>

        {{-- Values --}}
        <div class="border-t border-gray-200 pt-16">
            <div class="text-center mb-12">
                <h2 class="font-display text-4xl text-brand-dark tracking-wider">OUR CORE VALUES</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['title' => 'Honesty', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'desc' => 'We give you the full picture — no unnecessary repairs, no hidden fees, no jargon. Just straight talk about what your vehicle needs.'],
                    ['title' => 'Quality', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'desc' => 'We use quality parts and follow manufacturer specifications. Every repair is done right the first time, backed by a warranty.'],
                    ['title' => 'Community', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'desc' => "We're proud to be a part of the Stallings community. We treat every customer like a neighbor because many of you are."],
                ] as $value)
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-50 border-2 border-brand-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="font-display text-2xl text-brand-dark tracking-wider mb-3">{{ strtoupper($value['title']) }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Certifications & Partners --}}
        <div class="mt-16 bg-gray-50 rounded-2xl p-10">
            <h3 class="font-display text-3xl text-brand-dark tracking-wider text-center mb-8">CERTIFICATIONS & PARTNERS</h3>
            <div class="flex flex-wrap justify-center gap-6">
                @foreach(['ASE Certified', 'NAPA AutoCare', 'Advance Auto Parts', "O'Reilly Auto Parts", 'TechNet Professional'] as $partner)
                    <div class="bg-white border border-gray-200 rounded-lg px-6 py-4 text-center min-w-[140px]">
                        <span class="font-semibold text-brand-dark text-sm">{{ $partner }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-brand-primary py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="font-display text-4xl text-white tracking-wider mb-4">EXPERIENCE THE HARRIS DIFFERENCE</h2>
        <p class="text-red-100 mb-8">Schedule your service today and find out why customers keep coming back.</p>
        <a href="{{ route('appointments.create') }}"
           class="inline-flex items-center bg-white text-brand-primary px-10 py-4 font-display text-xl tracking-wider hover:bg-[#eff6ff] transition-colors">
            BOOK AN APPOINTMENT
        </a>
    </div>
</section>

@endsection
