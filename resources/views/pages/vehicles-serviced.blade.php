@extends('layouts.app')

@section('title', 'Vehicles We Service')
@section('meta_description', 'Harris Cars Service Center services all domestic and foreign vehicles in Stallings, NC. Honda, Toyota, Ford, BMW, Mercedes-Benz, Chevrolet, and more.')

@section('content')

<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">VEHICLES WE SERVICE</h1>
        <p class="text-gray-400 max-w-xl mx-auto">Our ASE Certified technicians are trained to service virtually all makes and models — foreign and domestic.</p>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-10">

            {{-- Domestic --}}
            <div>
                <div class="flex items-center mb-6">
                    <div class="w-2 h-8 bg-brand-primary mr-4"></div>
                    <h2 class="font-display text-3xl text-brand-dark tracking-wider">DOMESTIC VEHICLES</h2>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($domesticBrands as $brand)
                        <div class="flex items-center bg-gray-50 border border-gray-200 hover:border-brand-primary rounded p-3 transition-colors">
                            <svg class="w-4 h-4 text-brand-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            <span class="text-gray-700 text-sm font-medium">{{ $brand }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Foreign --}}
            <div>
                <div class="flex items-center mb-6">
                    <div class="w-2 h-8 bg-brand-primary mr-4"></div>
                    <h2 class="font-display text-3xl text-brand-dark tracking-wider">FOREIGN VEHICLES</h2>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($foreignBrands as $brand)
                        <div class="flex items-center bg-gray-50 border border-gray-200 hover:border-brand-primary rounded p-3 transition-colors">
                            <svg class="w-4 h-4 text-brand-primary mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            <span class="text-gray-700 text-sm font-medium">{{ $brand }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-12 bg-brand-dark rounded-2xl p-10 text-center">
            <h3 class="font-display text-3xl text-white tracking-wider mb-3">DON'T SEE YOUR VEHICLE?</h3>
            <p class="text-gray-400 mb-6">We service nearly all makes and models. Give us a call and we'll let you know if we can help.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:{{ format_phone(site_phone()) }}"
                   class="inline-flex items-center justify-center bg-brand-primary hover:bg-[#003370] text-white px-8 py-4 font-display text-xl tracking-wider transition-colors">
                    CALL {{ site_phone() }}
                </a>
                <a href="{{ route('appointments.create') }}"
                   class="inline-flex items-center justify-center border-2 border-gray-500 hover:border-white text-white px-8 py-4 font-display text-xl tracking-wider transition-colors">
                    BOOK APPOINTMENT
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
