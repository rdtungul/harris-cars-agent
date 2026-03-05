<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Get a site setting value by key.
     * Uses the Setting model with Redis cache.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('site_name')) {
    /**
     * Return the configured site name.
     */
    function site_name(): string
    {
        return setting('site_name', config('app.name', 'Harris Cars Service Center'));
    }
}

if (! function_exists('site_phone')) {
    /**
     * Return the configured business phone number.
     */
    function site_phone(): string
    {
        return setting('phone', '(704) 234-8351');
    }
}

if (! function_exists('site_email')) {
    /**
     * Return the configured business email.
     */
    function site_email(): string
    {
        return setting('email', 'info@harriscarsservicecenter.com');
    }
}

if (! function_exists('site_address')) {
    /**
     * Return the configured business address.
     */
    function site_address(): string
    {
        return setting('address', '2023 Richard Baker Dr, Stallings, NC 28104');
    }
}

if (! function_exists('format_phone')) {
    /**
     * Format a phone number for tel: href.
     * Strips all non-digit characters.
     */
    function format_phone(string $phone): string
    {
        return '+1' . preg_replace('/\D/', '', $phone);
    }
}
