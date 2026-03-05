<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * Zoho webhook must be excluded so Zoho's server can POST to it.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/zoho/webhook',
    ];
}
