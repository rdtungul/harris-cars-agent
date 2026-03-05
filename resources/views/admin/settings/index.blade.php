@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Site Settings')

@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="space-y-6">

        {{-- General Settings --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-brand-dark">
                <h2 class="font-display text-lg text-white tracking-wider">GENERAL INFORMATION</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach([
                    ['key' => 'site_name', 'label' => 'Business Name', 'default' => 'Harris Cars Service Center'],
                    ['key' => 'phone', 'label' => 'Phone Number', 'default' => '(704) 234-8351'],
                    ['key' => 'email', 'label' => 'Email Address', 'default' => 'info@harriscarsservicecenter.com'],
                    ['key' => 'address', 'label' => 'Street Address', 'default' => '2023 Richard Baker Dr, Stallings, NC 28104'],
                ] as $field)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $field['label'] }}</label>
                        <input type="text" name="settings[{{ $field['key'] }}]"
                               value="{{ old('settings.' . $field['key'], setting($field['key'], $field['default'])) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                    </div>
                @endforeach

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Business Hours</label>
                    <textarea name="settings[hours]" rows="3"
                              class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('settings.hours', setting('hours', "Monday – Friday: 8:00 AM – 5:00 PM\nSaturday – Sunday: Closed")) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Hero Content --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-brand-dark">
                <h2 class="font-display text-lg text-white tracking-wider">HERO SECTION</h2>
            </div>
            <div class="p-6 grid grid-cols-1 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hero Headline</label>
                    <input type="text" name="settings[hero_headline]"
                           value="{{ old('settings.hero_headline', setting('hero_headline', 'Your Car Deserves The Best')) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hero Subtext</label>
                    <textarea name="settings[hero_subtext]" rows="2"
                              class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('settings.hero_subtext', setting('hero_subtext', 'Premium automotive service in Stallings, NC.')) }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                        <input type="text" name="settings[years_experience]"
                               value="{{ old('settings.years_experience', setting('years_experience', '15+')) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vehicles Serviced</label>
                        <input type="text" name="settings[vehicles_serviced]"
                               value="{{ old('settings.vehicles_serviced', setting('vehicles_serviced', '10,000+')) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                    </div>
                </div>
            </div>
        </div>

        {{-- Social Media --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-brand-dark">
                <h2 class="font-display text-lg text-white tracking-wider">SOCIAL MEDIA & REVIEWS</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach([
                    ['key' => 'facebook_url', 'label' => 'Facebook URL'],
                    ['key' => 'yelp_url', 'label' => 'Yelp URL'],
                    ['key' => 'google_reviews_url', 'label' => 'Google Reviews URL'],
                    ['key' => 'surecritic_url', 'label' => 'SureCritic URL'],
                ] as $field)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $field['label'] }}</label>
                        <input type="url" name="settings[{{ $field['key'] }}]"
                               value="{{ old('settings.' . $field['key'], setting($field['key'])) }}"
                               placeholder="https://..."
                               class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Maps --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-brand-dark">
                <h2 class="font-display text-lg text-white tracking-wider">GOOGLE MAPS</h2>
            </div>
            <div class="p-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Google Maps Embed URL</label>
                <p class="text-xs text-gray-400 mb-2">Get this from Google Maps &rarr; Share &rarr; Embed a map &rarr; copy the src="" URL only.</p>
                <input type="text" name="settings[google_maps_embed_url]"
                       value="{{ old('settings.google_maps_embed_url', setting('google_maps_embed_url', env('GOOGLE_MAPS_EMBED_URL'))) }}"
                       placeholder="https://www.google.com/maps/embed?pb=..."
                       class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary">
            </div>
        </div>

        {{-- SEO --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-brand-dark">
                <h2 class="font-display text-lg text-white tracking-wider">SEO / META</h2>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Default Meta Description</label>
                    <textarea name="settings[meta_description]" rows="3"
                              class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm focus:ring-brand-primary focus:border-brand-primary resize-none">{{ old('settings.meta_description', setting('meta_description')) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Zoho Forms --}}
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-brand-dark">
                <h2 class="font-display text-lg text-white tracking-wider">ZOHO WEB FORMS</h2>
            </div>
            <div class="p-6 space-y-5">
                <div class="bg-blue-50 border border-blue-200 rounded p-4 text-sm text-blue-800">
                    <strong>How to get embed codes:</strong> In Zoho Forms, open your form &rarr; Share &rarr; Embed &rarr; Copy the full embed HTML. Paste it in the fields below.
                </div>

                @foreach([
                    ['key' => 'zoho_contact_form_embed', 'label' => 'Contact Us Form Embed Code'],
                    ['key' => 'zoho_booking_form_embed', 'label' => 'Appointment Booking Form Embed Code'],
                    ['key' => 'zoho_review_form_embed', 'label' => 'Leave a Review Form Embed Code'],
                    ['key' => 'zoho_quote_form_embed', 'label' => 'Get a Quote Form Embed Code'],
                ] as $field)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $field['label'] }}</label>
                        <textarea name="settings[{{ $field['key'] }}]" rows="3"
                                  placeholder='<iframe src="https://forms.zohopublic.com/..." ...'
                                  class="w-full border border-gray-300 rounded px-3 py-2.5 text-sm font-mono focus:ring-brand-primary focus:border-brand-primary resize-y">{{ old('settings.' . $field['key'], setting($field['key'])) }}</textarea>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    <div class="mt-6 sticky bottom-0 bg-white border-t border-gray-200 px-6 py-4 flex gap-4 shadow-lg rounded-lg">
        <button type="submit" class="bg-brand-primary hover:bg-[#003370] text-white px-10 py-3 font-display text-lg tracking-wider transition-colors rounded">
            SAVE ALL SETTINGS
        </button>
        <button type="reset" class="border border-gray-300 text-gray-600 px-8 py-3 font-semibold rounded hover:bg-gray-50 transition-colors">
            Reset
        </button>
    </div>
</form>

@endsection
