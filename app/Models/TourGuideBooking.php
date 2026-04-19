<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuideBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_guide_id',
        'booking_date',
        'days',
        'total_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_amount' => 'decimal:2',
        'days' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourGuide()
    {
        return $this->belongsTo(TourGuide::class);
    }
}
