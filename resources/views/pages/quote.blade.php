@extends('layouts.app')

@section('title', 'Get a Free Quote')
@section('meta_description', 'Get a free auto repair estimate from Harris Cars Service Center in Stallings, NC. Tell us about your vehicle and we will provide an honest, upfront quote.')

@section('content')

<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">GET A FREE QUOTE</h1>
        <p class="text-gray-400 max-w-xl mx-auto">Tell us about your vehicle and what service you need. We will provide a transparent, honest estimate before any work begins.</p>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm p-8">
            @if(setting('zoho_quote_form_embed'))
                {!! setting('zoho_quote_form_embed') !!}
            @else
                <h2 class="font-display text-2xl text-brand-dark tracking-wider mb-2">REQUEST A QUOTE</h2>
                <p class="text-gray-500 text-sm mb-6">Fill out the form below and we will get back to you with a detailed estimate within 1 business day.</p>

                <div class="bg-blue-50 border border-blue-200 rounded p-4 mb-6 text-sm text-blue-800">
                    For the fastest quote, call us directly at <strong><a href="tel:{{ format_phone(site_phone()) }}" class="hover:underline">{{ site_phone() }}</a></strong> (Mon–Fri, 8 AM – 5 PM).
                </div>

                <p class="text-gray-500 text-sm">Configure your Zoho Quote Form embed code in <a href="{{ route('admin.settings.index') }}" class="text-brand-primary hover:underline">Admin &rarr; Settings &rarr; Zoho Web Forms</a> to enable this form.</p>

                <div class="mt-8 flex gap-4">
                    <a href="tel:{{ format_phone(site_phone()) }}"
                       class="inline-flex items-center justify-center bg-brand-primary hover:bg-[#003370] text-white px-8 py-4 font-display text-xl tracking-wider transition-colors">
                        CALL NOW
                    </a>
                    <a href="{{ route('appointments.create') }}"
                       class="inline-flex items-center justify-center border-2 border-brand-dark text-brand-dark hover:bg-brand-dark hover:text-white px-8 py-4 font-display text-xl tracking-wider transition-colors">
                        BOOK APPOINTMENT
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
