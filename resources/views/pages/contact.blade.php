@extends('layouts.app')

@section('title', 'Contact Us')
@section('meta_description', 'Contact Harris Cars Service Center in Stallings, NC. Call (704) 234-8351 or visit us at 2023 Richard Baker Dr. Mon-Fri 8AM-5PM.')

@section('content')

<div class="bg-brand-dark py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-display text-5xl sm:text-6xl text-white tracking-wider mb-4">CONTACT US</h1>
        <p class="text-gray-400 max-w-xl mx-auto">We're here to help. Reach out by phone, email, or the form below.</p>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-10">

            {{-- Contact Info --}}
            <div class="space-y-5">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="font-display text-xl text-brand-dark tracking-wider mb-5">GET IN TOUCH</h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-brand-dark text-sm">Phone</p>
                                <a href="tel:{{ format_phone(site_phone()) }}" class="text-brand-primary hover:text-[#003370] transition-colors font-medium">
                                    {{ site_phone() }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-brand-dark text-sm">Email</p>
                                <a href="mailto:{{ site_email() }}" class="text-brand-primary hover:text-[#003370] transition-colors text-sm">
                                    {{ site_email() }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-primary" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-brand-dark text-sm">Address</p>
                                <p class="text-gray-600 text-sm">{{ site_address() }}</p>
                                <a href="https://maps.google.com/?q=2023+Richard+Baker+Dr+Stallings+NC+28104"
                                   target="_blank" class="text-brand-primary text-xs hover:underline">
                                    Get Directions &rarr;
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-brand-dark text-sm">Hours</p>
                                <p class="text-gray-600 text-sm">Mon–Fri: 8:00 AM – 5:00 PM</p>
                                <p class="text-gray-500 text-sm">Saturday–Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-brand-primary rounded-lg p-6 text-center">
                    <p class="text-white font-semibold mb-2">Ready to Schedule?</p>
                    <a href="{{ route('appointments.create') }}"
                       class="inline-block bg-white text-brand-primary px-6 py-2.5 font-display text-lg tracking-wider hover:bg-[#eff6ff] transition-colors">
                        BOOK ONLINE
                    </a>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 p-8">
                <h2 class="font-display text-2xl text-brand-dark tracking-wider mb-6">SEND US A MESSAGE</h2>

                @if(setting('zoho_contact_form_embed'))
                    {!! setting('zoho_contact_form_embed') !!}
                @else
                    <p class="text-gray-500 text-sm mb-4">Fill out the form below and we'll get back to you as soon as possible. For faster service, please call us directly.</p>
                    <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-6 text-sm text-yellow-800">
                        <strong>Note:</strong> For faster response, call us at <a href="tel:{{ format_phone(site_phone()) }}" class="font-bold hover:underline">{{ site_phone() }}</a> or <a href="{{ route('appointments.create') }}" class="font-bold hover:underline">book your appointment online</a>.
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                            <textarea rows="5" class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none"></textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit" class="w-full bg-brand-primary hover:bg-[#003370] text-white py-3 font-display text-lg tracking-wider transition-colors">
                                SEND MESSAGE
                            </button>
                            <p class="text-xs text-gray-400 text-center mt-2">Configure the Zoho Contact Form in Admin > Settings to enable form submission.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Map --}}
        <div class="mt-10 rounded-lg overflow-hidden h-72">
            @php $mapEmbed = setting('google_maps_embed_url', env('GOOGLE_MAPS_EMBED_URL', '')); @endphp
            @if($mapEmbed)
                <iframe src="{{ $mapEmbed }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" title="Map"></iframe>
            @else
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <div class="text-center">
                        <p class="text-gray-500 font-medium">{{ site_address() }}</p>
                        <a href="https://maps.google.com/?q=2023+Richard+Baker+Dr+Stallings+NC+28104" target="_blank"
                           class="text-brand-primary text-sm hover:underline mt-1 inline-block">Open in Google Maps &rarr;</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
