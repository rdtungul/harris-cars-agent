@extends('layouts.app')

@section('title', 'Schedule an Appointment')
@section('meta_description', 'Book your auto service appointment online at Harris Cars Service Center in Stallings, NC. Fast, easy scheduling for oil changes, brakes, diagnostics, and more.')

@section('content')

{{-- Header --}}
<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-brand-primary font-semibold uppercase tracking-widest text-sm mb-2">Get Started</p>
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">BOOK AN APPOINTMENT</h1>
        <p class="text-gray-400 max-w-xl mx-auto">Fill out the form below and we will contact you within 1 business day to confirm your appointment.</p>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Check if Zoho form is configured --}}
        @if(setting('zoho_booking_form_embed'))
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-sm p-8">
                <h2 class="font-display text-2xl text-brand-dark tracking-wider mb-6">SCHEDULE YOUR SERVICE</h2>
                {!! setting('zoho_booking_form_embed') !!}
            </div>
        @else
            {{-- Native form --}}
            <div class="grid lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm p-8">
                        <h2 class="font-display text-2xl text-brand-dark tracking-wider mb-6">APPOINTMENT DETAILS</h2>

                        <form method="POST" action="{{ route('appointments.store') }}" x-data="{ selectedService: '{{ request('service', '') }}' }">
                            @csrf

                            {{-- Contact Info --}}
                            <fieldset class="mb-8">
                                <legend class="font-semibold text-brand-dark text-sm uppercase tracking-wider mb-4 pb-2 border-b border-gray-200 w-full">Your Information</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-brand-primary">*</span></label>
                                        <input type="text" id="customer_name" name="customer_name"
                                               value="{{ old('customer_name') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary @error('customer_name') border-red-500 @enderror">
                                        @error('customer_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-brand-primary">*</span></label>
                                        <input type="tel" id="phone" name="phone"
                                               value="{{ old('phone') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary @error('phone') border-red-500 @enderror">
                                        @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-brand-primary">*</span></label>
                                        <input type="email" id="email" name="email"
                                               value="{{ old('email') }}" required
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary @error('email') border-red-500 @enderror">
                                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </fieldset>

                            {{-- Vehicle Info --}}
                            <fieldset class="mb-8">
                                <legend class="font-semibold text-brand-dark text-sm uppercase tracking-wider mb-4 pb-2 border-b border-gray-200 w-full">Vehicle Information</legend>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    <div>
                                        <label for="vehicle_year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                                        <input type="number" id="vehicle_year" name="vehicle_year"
                                               value="{{ old('vehicle_year') }}"
                                               min="1900" max="{{ date('Y') + 1 }}" placeholder="{{ date('Y') }}"
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                                    </div>
                                    <div>
                                        <label for="vehicle_make" class="block text-sm font-medium text-gray-700 mb-1">Make</label>
                                        <input type="text" id="vehicle_make" name="vehicle_make"
                                               value="{{ old('vehicle_make') }}" placeholder="e.g. Toyota"
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                                    </div>
                                    <div>
                                        <label for="vehicle_model" class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                                        <input type="text" id="vehicle_model" name="vehicle_model"
                                               value="{{ old('vehicle_model') }}" placeholder="e.g. Camry"
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                                    </div>
                                    <div>
                                        <label for="vehicle_mileage" class="block text-sm font-medium text-gray-700 mb-1">Mileage</label>
                                        <input type="text" id="vehicle_mileage" name="vehicle_mileage"
                                               value="{{ old('vehicle_mileage') }}" placeholder="e.g. 45,000"
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                                    </div>
                                </div>
                            </fieldset>

                            {{-- Service & Scheduling --}}
                            <fieldset class="mb-8">
                                <legend class="font-semibold text-brand-dark text-sm uppercase tracking-wider mb-4 pb-2 border-b border-gray-200 w-full">Service & Scheduling</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div class="sm:col-span-2">
                                        <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Service Needed</label>
                                        <select id="service_id" name="service_id"
                                                class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                                            <option value="">-- Select a Service --</option>
                                            @foreach($categories as $cat)
                                                <optgroup label="{{ $cat->name }}">
                                                    @foreach($cat->activeServices as $svc)
                                                        <option value="{{ $svc->id }}"
                                                                {{ old('service_id', request('service')) == $svc->id ? 'selected' : '' }}>
                                                            {{ $svc->title }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-1">Preferred Date</label>
                                        <input type="date" id="preferred_date" name="preferred_date"
                                               value="{{ old('preferred_date') }}"
                                               min="{{ date('Y-m-d') }}"
                                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                                    </div>
                                    <div>
                                        <label for="preferred_time" class="block text-sm font-medium text-gray-700 mb-1">Preferred Time</label>
                                        <select id="preferred_time" name="preferred_time"
                                                class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                                            <option value="">-- Select Time --</option>
                                            @foreach($timeSlots as $slot)
                                                <option value="{{ $slot }}" {{ old('preferred_time') == $slot ? 'selected' : '' }}>{{ $slot }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                                        <textarea id="notes" name="notes" rows="4"
                                                  placeholder="Describe your issue, symptoms, or any specific concerns..."
                                                  class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <button type="submit"
                                    class="w-full bg-brand-primary hover:bg-[#003370] text-white py-4 font-display text-xl tracking-wider transition-colors">
                                SUBMIT APPOINTMENT REQUEST
                            </button>
                            <p class="text-xs text-gray-400 text-center mt-3">We will contact you within 1 business day to confirm your appointment.</p>
                        </form>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-5">
                    <div class="bg-brand-dark text-white rounded-lg p-6">
                        <h3 class="font-display text-xl tracking-wider mb-4">CONTACT US DIRECTLY</h3>
                        <div class="space-y-3">
                            <a href="tel:{{ format_phone(site_phone()) }}"
                               class="flex items-center text-gray-300 hover:text-white transition-colors">
                                <svg class="w-5 h-5 text-brand-primary mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                                <span class="text-sm">{{ site_phone() }}</span>
                            </a>
                            <div class="flex items-start text-gray-300">
                                <svg class="w-5 h-5 text-brand-primary mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                                <span class="text-sm">{{ site_address() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="font-display text-xl text-brand-dark tracking-wider mb-4">SHOP HOURS</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mon – Fri</span>
                                <span class="font-semibold text-brand-dark">8:00 AM – 5:00 PM</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Saturday</span>
                                <span class="text-red-500 font-medium">Closed</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sunday</span>
                                <span class="text-red-500 font-medium">Closed</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-5">
                        <h4 class="font-semibold text-green-800 text-sm mb-2">What to Expect</h4>
                        <ul class="text-green-700 text-xs space-y-1.5">
                            <li class="flex items-start"><span class="text-green-500 mr-2 mt-0.5">✓</span> We respond within 1 business day</li>
                            <li class="flex items-start"><span class="text-green-500 mr-2 mt-0.5">✓</span> Free diagnosis with most services</li>
                            <li class="flex items-start"><span class="text-green-500 mr-2 mt-0.5">✓</span> Upfront pricing before any work begins</li>
                            <li class="flex items-start"><span class="text-green-500 mr-2 mt-0.5">✓</span> Appointment confirmation via email</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
