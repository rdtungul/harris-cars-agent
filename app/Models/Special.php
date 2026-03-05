<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Special extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount_text',
        'original_price',
        'sale_price',
        'image',
        'valid_from',
        'valid_until',
        'is_active',
        'coupon_code',
        'order',
    ];

    protected $casts = [
        'valid_from'  => 'date',
        'valid_until' => 'date',
        'is_active'   => 'boolean',
        'order'       => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('valid_until')
                  ->orWhere('valid_until', '>=', now()->toDateString());
            });
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->valid_until && $this->valid_until->isPast();
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/special-placeholder.jpg');
    }
}
