@extends('layouts.app')

@section('title', 'Appointment Submitted')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center py-20">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="bg-white rounded-2xl shadow-lg p-12">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="font-display text-4xl text-brand-dark tracking-wider mb-4">APPOINTMENT SUBMITTED!</h1>

            @if(session('confirmation_number'))
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                    <p class="text-gray-500 text-sm mb-1">Your Confirmation Number</p>
                    <p class="font-display text-3xl text-brand-primary tracking-wider">{{ session('confirmation_number') }}</p>
                </div>
            @endif

            <p class="text-gray-600 mb-8 leading-relaxed">
                Thank you for booking with Harris Cars Service Center. We have received your appointment request and will contact you within <strong>1 business day</strong> to confirm your appointment time.
            </p>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 text-left mb-8">
                <h3 class="font-semibold text-blue-800 mb-2 text-sm">Need to reach us sooner?</h3>
                <p class="text-blue-700 text-sm">Call us directly at <a href="tel:{{ format_phone(site_phone()) }}" class="font-bold hover:underline">{{ site_phone() }}</a> during business hours (Mon–Fri, 8 AM – 5 PM).</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center justify-center bg-brand-dark hover:bg-gray-800 text-white px-6 py-3 font-display text-lg tracking-wider transition-colors">
                    BACK TO HOME
                </a>
                <a href="{{ route('services.index') }}"
                   class="inline-flex items-center justify-center border-2 border-brand-dark text-brand-dark hover:bg-brand-dark hover:text-white px-6 py-3 font-display text-lg tracking-wider transition-colors">
                    VIEW SERVICES
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
