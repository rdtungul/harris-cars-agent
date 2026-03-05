<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'customer_name',
        'customer_location',
        'customer_vehicle',
        'rating',
        'review',
        'is_approved',
        'is_featured',
        'source',
        'source_url',
    ];

    protected $casts = [
        'rating'      => 'integer',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopeHighRated($query, int $minRating = 4)
    {
        return $query->where('rating', '>=', $minRating);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getStarsAttribute(): string
    {
        $filled = str_repeat('★', $this->rating);
        $empty  = str_repeat('☆', 5 - $this->rating);
        return $filled . $empty;
    }

    public function getStarsFilledAttribute(): string
    {
        return str_repeat('★', $this->rating);
    }

    public function getStarsEmptyAttribute(): string
    {
        return str_repeat('☆', 5 - $this->rating);
    }

    public function getReviewExcerptAttribute(): string
    {
        return \Illuminate\Support\Str::limit($this->review, 180);
    }

    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', $this->customer_name);
        $initials = '';
        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }
        return $initials;
    }
}
