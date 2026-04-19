<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_name',
        'tour_date',
        'number_of_people',
        'selected_spots',
        'selected_foods',
        'spots_total',
        'food_total',
        'total_price',
        'payment_method',
        'payment_mode',
        'downpayment_amount',
        'payment_status',
        'notes',
        'status',
    ];

    protected $casts = [
        'selected_spots' => 'array',
        'selected_foods' => 'array',
        'spots_total' => 'decimal:2',
        'food_total' => 'decimal:2',
        'total_price' => 'decimal:2',
        'downpayment_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}