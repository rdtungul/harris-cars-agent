<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'image_path',
        'caption',
        'alt_text',
        'category',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    const CATEGORIES = [
        'general'      => 'General',
        'before-after' => 'Before & After',
        'facility'     => 'Facility',
        'team'         => 'Team',
    ];

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    public function getAltAttribute(): string
    {
        return $this->alt_text ?? $this->caption ?? 'Harris Cars Service Center Gallery';
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }
}
