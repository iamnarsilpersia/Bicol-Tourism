<?php

use App\Models\Restaurant;
use App\Models\CustomTour;
use App\Models\TourPackage;
use App\Models\TouristSpot;
use App\Models\Hotel;
use App\Models\Shop;
use App\Models\Souvenir;
use App\Models\TourGuide;

$restaurants = [
    ['name' => 'One Destination Restaurant', 'description' => 'Famous restaurant serving authentic Bicolano cuisine. Try the spicy pork!', 'address' => 'Brgy. 9, Cagsawa, Daraga, Albay', 'latitude' => 13.1585, 'longitude' => 123.7315, 'contact_number' => '+63 52 456 7890', 'cuisine_type' => 'Bicolano', 'price_range' => 300, 'rating' => '4.5', 'is_active' => true],
    ['name' => 'Krustytask', 'description' => 'Popular seafood restaurant near the airport. Fresh catches daily!', 'address' => 'Airport Road, Legazpi City', 'latitude' => 13.1290, 'longitude' => 123.7350, 'contact_number' => '+63 52 480 9000', 'cuisine_type' => 'Seafood', 'price_range' => 400, 'rating' => '4.3', 'is_active' => true],
    ['name' => 'Balay da Bato', 'description' => 'Heritage restaurant with traditional Bicolano dishes and modern twist', 'address' => 'F. Quan Zone, Legazpi City', 'latitude' => 13.1400, 'longitude' => 123.7420, 'contact_number' => '+63 52 480 1234', 'cuisine_type' => 'Filipino', 'price_range' => 350, 'rating' => '4.6', 'is_active' => true],
    ['name' => 'Tierra de Maria Restaurant', 'description' => 'Farm-to-table restaurant with organic ingredients and local flavors', 'address' => 'Sto. Domingo, Albay', 'latitude' => 13.2180, 'longitude' => 123.8150, 'contact_number' => '+63 52 480 5678', 'cuisine_type' => 'Fusion', 'price_range' => 450, 'rating' => '4.4', 'is_active' => true],
];

foreach ($restaurants as $r) {
    Restaurant::create($r);
}

echo "Restaurants seeded successfully!\n";