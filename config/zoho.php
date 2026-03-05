<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Zoho Integration Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Zoho CRM webhook integration and form embeds.
    | All sensitive values should be stored in .env file.
    |
    */

    'webhook_secret' => env('ZOHO_WEBHOOK_SECRET', ''),

    'forms' => [
        'contact'  => env('ZOHO_CONTACT_FORM_EMBED', ''),
        'booking'  => env('ZOHO_BOOKING_FORM_EMBED', ''),
        'review'   => env('ZOHO_REVIEW_FORM_EMBED', ''),
        'quote'    => env('ZOHO_QUOTE_FORM_EMBED', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Zoho Form Names (must match form_name field sent in webhook payload)
    |--------------------------------------------------------------------------
    */
    'form_names' => [
        'contact'     => 'Contact Us',
        'appointment' => 'Appointment Booking',
        'review'      => 'Leave a Review',
        'quote'       => 'Get a Quote',
    ],
];
