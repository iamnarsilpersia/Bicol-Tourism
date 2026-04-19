<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristSpot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'latitude',
        'longitude',
        'category',
        'entry_fee',
        'image',
        'media',
        'contact_number',
        'basic_info',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'entry_fee' => 'decimal:2',
    ];

    public function tourPackages()
    {
        return $this->belongsToMany(TourPackage::class, 'package_spot')
                    ->withPivot('day_number', 'order')
                    ->withTimestamps();
    }
}
