<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZohoFormSubmission extends Model
{
    protected $table = 'zoho_form_submissions';

    protected $fillable = [
        'form_name',
        'payload',
        'ip_address',
        'processed_at',
        'processing_status',
        'processing_notes',
    ];

    protected $casts = [
        'payload'      => 'array',
        'processed_at' => 'datetime',
    ];

    public function scopeReceived($query)
    {
        return $query->where('processing_status', 'received');
    }

    public function scopeProcessed($query)
    {
        return $query->where('processing_status', 'processed');
    }

    public function scopeFailed($query)
    {
        return $query->where('processing_status', 'failed');
    }
}
