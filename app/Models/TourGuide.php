<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'photo',
        'daily_rate',
        'is_available',
        'languages',
    ];

    protected $casts = [
        'daily_rate' => 'decimal:2',
        'languages' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(TourGuideBooking::class);
    }
}
