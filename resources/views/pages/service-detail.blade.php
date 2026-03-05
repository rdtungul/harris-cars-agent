@extends('layouts.app')

@section('title', $service->meta_title ?? $service->title . ' — Auto Repair Stallings NC')
@section('meta_description', $service->meta_description ?? $service->short_description)

@section('content')

{{-- Header --}}
<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Services</a>
            @if($service->category)
                <span class="mx-2">/</span>
                <a href="{{ route('services.index') }}#{{ $service->category->slug }}" class="hover:text-white transition-colors">{{ $service->category->name }}</a>
            @endif
            <span class="mx-2">/</span>
            <span class="text-gray-300">{{ $service->title }}</span>
        </nav>
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider">{{ strtoupper($service->title) }}</h1>
        @if($service->short_description)
            <p class="text-gray-400 mt-4 max-w-2xl text-lg">{{ $service->short_description }}</p>
        @endif
        <div class="flex flex-wrap gap-4 mt-6">
            @if($service->price_range)
                <span class="inline-flex items-center bg-brand-primary/20 border border-brand-primary/40 text-brand-primary px-4 py-2 rounded text-sm font-semibold">
                    {{ $service->price_range }}
                </span>
            @endif
            @if($service->duration)
                <span class="inline-flex items-center bg-gray-700 text-gray-300 px-4 py-2 rounded text-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $service->duration }}
                </span>
            @endif
        </div>
    </div>
</div>

{{-- Content --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                @if($service->image)
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}"
                         class="w-full h-72 object-cover rounded-lg mb-8">
                @endif

                @if($service->description)
                    <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($service->description)) !!}
                    </div>
                @endif

                {{-- Service Testimonials --}}
                @if($service->testimonials->isNotEmpty())
                    <div class="mt-12">
                        <h3 class="font-display text-2xl text-brand-dark tracking-wider mb-6">WHAT CUSTOMERS SAY</h3>
                        <div class="space-y-4">
                            @foreach($service->testimonials as $review)
                                <div class="border border-gray-200 rounded-lg p-5 border-l-4 border-l-brand-primary">
                                    <div class="flex items-center mb-2">
                                        <span class="text-yellow-500">
                                            @for($i = 0; $i < $review->rating; $i++)★@endfor
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm italic mb-3">"{{ $review->review }}"</p>
                                    <p class="font-semibold text-sm text-brand-dark">{{ $review->customer_name }}
                                        @if($review->customer_location)
                                            <span class="text-gray-400 font-normal">— {{ $review->customer_location }}</span>
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Book CTA --}}
                <div class="bg-brand-dark rounded-lg p-6 text-center">
                    <h3 class="font-display text-2xl text-white tracking-wider mb-2">BOOK THIS SERVICE</h3>
                    <p class="text-gray-400 text-sm mb-5">Schedule your appointment online or give us a call.</p>
                    <a href="{{ route('appointments.create') }}?service={{ $service->id }}"
                       class="block bg-brand-primary hover:bg-[#003370] text-white px-6 py-3 font-display text-lg tracking-wider transition-colors mb-3">
                        SCHEDULE NOW
                    </a>
                    <a href="tel:{{ format_phone(site_phone()) }}"
                       class="block border border-gray-600 hover:border-white text-gray-300 hover:text-white px-6 py-3 font-semibold text-sm transition-colors">
                        {{ site_phone() }}
                    </a>
                </div>

                {{-- Hours --}}
                <div class="border border-gray-200 rounded-lg p-5">
                    <h4 class="font-display text-lg text-brand-dark tracking-wider mb-3">SHOP HOURS</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Monday – Friday</span>
                            <span class="font-medium text-brand-dark">8:00 AM – 5:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Saturday</span>
                            <span class="font-medium text-red-500">Closed</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sunday</span>
                            <span class="font-medium text-red-500">Closed</span>
                        </div>
                    </div>
                </div>

                {{-- Related Services --}}
                @if($relatedServices->isNotEmpty())
                    <div class="border border-gray-200 rounded-lg p-5">
                        <h4 class="font-display text-lg text-brand-dark tracking-wider mb-3">RELATED SERVICES</h4>
                        <div class="space-y-2">
                            @foreach($relatedServices as $related)
                                <a href="{{ route('services.show', $related->slug) }}"
                                   class="flex items-center text-sm text-gray-600 hover:text-brand-primary transition-colors py-1 border-b border-gray-100 last:border-0">
                                    <svg class="w-3 h-3 mr-2 text-brand-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    {{ $related->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
