<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Appointment extends Model
{
    use HasFactory;

    const STATUS_PENDING    = 'pending';
    const STATUS_CONFIRMED  = 'confirmed';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED  = 'completed';
    const STATUS_CANCELLED  = 'cancelled';

    const ALL_STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
        self::STATUS_IN_PROGRESS,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
    ];

    protected $fillable = [
        'service_id',
        'customer_name',
        'email',
        'phone',
        'vehicle_year',
        'vehicle_make',
        'vehicle_model',
        'vehicle_trim',
        'vehicle_mileage',
        'preferred_date',
        'preferred_time',
        'notes',
        'status',
        'source',
        'confirmation_number',
        'internal_notes',
    ];

    protected $casts = [
        'preferred_date' => 'date',
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

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeUpcoming($query)
    {
        return $query->whereIn('status', [self::STATUS_PENDING, self::STATUS_CONFIRMED])
            ->where('preferred_date', '>=', now()->toDateString())
            ->orderBy('preferred_date');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getVehicleFullNameAttribute(): string
    {
        return trim("{$this->vehicle_year} {$this->vehicle_make} {$this->vehicle_model} {$this->vehicle_trim}");
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING     => 'yellow',
            self::STATUS_CONFIRMED   => 'blue',
            self::STATUS_IN_PROGRESS => 'brand-blue',
            self::STATUS_COMPLETED   => 'green',
            self::STATUS_CANCELLED   => 'red',
            default                  => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING     => 'Pending',
            self::STATUS_CONFIRMED   => 'Confirmed',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED   => 'Completed',
            self::STATUS_CANCELLED   => 'Cancelled',
            default                  => ucfirst($this->status),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Boot
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {
        static::creating(function (Appointment $appointment) {
            if (empty($appointment->confirmation_number)) {
                $appointment->confirmation_number = 'HCS-' . strtoupper(Str::random(8));
            }
        });
    }
}
