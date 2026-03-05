<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name',        'value' => 'Harris Cars Service Center', 'type' => 'text',     'group' => 'general', 'label' => 'Business Name'],
            ['key' => 'phone',            'value' => '(704) 234-8351',             'type' => 'text',     'group' => 'general', 'label' => 'Phone Number'],
            ['key' => 'email',            'value' => 'info@harriscarsservicecenter.com', 'type' => 'text', 'group' => 'general', 'label' => 'Email Address'],
            ['key' => 'address',          'value' => '2023 Richard Baker Dr, Stallings, NC 28104', 'type' => 'text', 'group' => 'general', 'label' => 'Address'],
            ['key' => 'hours',            'value' => "Monday – Friday: 8:00 AM – 5:00 PM\nSaturday – Sunday: Closed", 'type' => 'textarea', 'group' => 'general', 'label' => 'Business Hours'],

            // Hero
            ['key' => 'hero_headline',    'value' => 'Your Car Deserves The Best', 'type' => 'text',     'group' => 'appearance', 'label' => 'Hero Headline'],
            ['key' => 'hero_subtext',     'value' => 'Premium automotive service in Stallings, NC. Honest pricing, certified technicians, and reliable repairs for all domestic and foreign vehicles.', 'type' => 'textarea', 'group' => 'appearance', 'label' => 'Hero Subtext'],

            // Stats
            ['key' => 'years_experience',  'value' => '15+',    'type' => 'text', 'group' => 'general', 'label' => 'Years of Experience'],
            ['key' => 'vehicles_serviced', 'value' => '10,000+', 'type' => 'text', 'group' => 'general', 'label' => 'Vehicles Serviced'],
            ['key' => 'happy_customers',   'value' => '5,000+',  'type' => 'text', 'group' => 'general', 'label' => 'Happy Customers'],

            // Social
            ['key' => 'facebook_url',      'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Facebook URL'],
            ['key' => 'yelp_url',          'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Yelp URL'],
            ['key' => 'google_reviews_url','value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Google Reviews URL'],
            ['key' => 'surecritic_url',    'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'SureCritic URL'],

            // Maps
            ['key' => 'google_maps_embed_url', 'value' => '', 'type' => 'text', 'group' => 'contact', 'label' => 'Google Maps Embed URL'],

            // SEO
            ['key' => 'meta_description', 'value' => 'Harris Cars Service Center — Premium automotive service in Stallings, NC. ASE Certified technicians, honest pricing, and reliable repairs for all domestic and foreign vehicles.', 'type' => 'textarea', 'group' => 'seo', 'label' => 'Default Meta Description'],

            // Zoho
            ['key' => 'zoho_contact_form_embed', 'value' => '', 'type' => 'textarea', 'group' => 'zoho', 'label' => 'Contact Form Embed Code'],
            ['key' => 'zoho_booking_form_embed', 'value' => '', 'type' => 'textarea', 'group' => 'zoho', 'label' => 'Booking Form Embed Code'],
            ['key' => 'zoho_review_form_embed',  'value' => '', 'type' => 'textarea', 'group' => 'zoho', 'label' => 'Review Form Embed Code'],
            ['key' => 'zoho_quote_form_embed',   'value' => '', 'type' => 'textarea', 'group' => 'zoho', 'label' => 'Quote Form Embed Code'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Settings seeded.');
    }
}
