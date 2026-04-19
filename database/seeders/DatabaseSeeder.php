<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TouristSpot;
use App\Models\TourPackage;
use App\Models\TourGuide;
use App\Models\Hotel;
use App\Models\Shop;
use App\Models\Souvenir;
use App\Models\Restaurant;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@bicoltourism.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '09123456789',
            'address' => 'Bicol Region, Philippines',
        ]);

        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@bicoltourism.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '09987654321',
            'address' => 'Legazpi City, Albay',
        ]);

        $spot1 = TouristSpot::create([
            'name' => 'Mayon Volcano',
            'description' => 'Mayon Volcano, known as the "Perfect Cone", is an active stratovolcano in the province of Albay, Bicol Region. Its symmetrically cone-shaped form and proximity to the city of Legazpi makes it one of the most iconic natural landmarks in the Philippines.',
            'location' => 'Albay, Philippines',
            'latitude' => 13.2540,
            'longitude' => 123.7540,
            'category' => 'Volcano',
            'entry_fee' => 0,
            'contact_number' => '+63 52 123 4567',
            'basic_info' => '• Height: 2,462 meters above sea level\n• Known as the "Perfect Cone"\n• Active volcano with frequent eruptions\n• Best viewed from Ligñon Hill and Cagsawa Ruins\n• ATV tours and trekking available',
            'is_active' => true,
        ]);

        $spot2 = TouristSpot::create([
            'name' => 'Cagsawa Ruins',
            'description' => 'The Cagsawa Ruins are the remains of a 16th-century Spanish church built by Franciscan friars. The church was destroyed by the eruption of Mayon Volcano in 1814. The iconic bell tower that protrudes from the rubble is the most photographed structure in Bicol.',
            'location' => 'Cagsawa, Daraga, Albay',
            'latitude' => 13.1575,
            'longitude' => 123.7303,
            'category' => 'Historical',
            'entry_fee' => 50,
            'contact_number' => '+63 52 234 5678',
            'basic_info' => '• Built in 1572 by Spanish missionaries\n• Destroyed by Mayon eruption in 1814\n• The bell tower survived the eruption\n• Historic site with cultural significance\n• Souvenir shops and restaurants nearby',
            'is_active' => true,
        ]);

        $spot3 = TouristSpot::create([
            'name' => 'Donsol Whale Shark Interaction',
            'description' => 'Donsol in Sorsogon is known as the "Whale Shark Capital of the World". Visitors can swim and dive with these gentle giants, known locally as "butanding". The best time to see them is from November to June.',
            'location' => 'Donsol, Sorsogon',
            'latitude' => 12.2142,
            'longitude' => 123.5787,
            'category' => 'Marine',
            'entry_fee' => 500,
            'contact_number' => '+63 56 345 6789',
            'basic_info' => '• Whale shark watching season: November to June\n• Guided swimming with whale sharks\n• PADI certified diving operators available\n• Marine sanctuary with conservation programs\n• Experience the "butanding" interaction',
            'is_active' => true,
        ]);

        $spot4 = TouristSpot::create([
            'name' => 'Camiguin Island (White Island)',
            'description' => 'Camiguin Island is known for its white sand beaches, volcanic landscape, and friendly locals. White Island is a horseshoe-shaped sandbar off the coast, perfect for beach lovers and photographers.',
            'location' => 'Camiguin Island, Surigao del Norte',
            'latitude' => 9.0771,
            'longitude' => 124.6735,
            'category' => 'Beach',
            'entry_fee' => 0,
            'contact_number' => '+63 88 456 7890',
            'basic_info' => '• White sand beach paradise\n• Best visited during low tide\n• Boat trips from Camiguin mainland\n• Snorkeling and diving spots\n• Sunrises and sunsets are spectacular',
            'is_active' => true,
        ]);

        $spot5 = TouristSpot::create([
            'name' => 'Mount Bulusan',
            'description' => 'Mount Bulusan is an active volcano and the second most active volcano in the Philippines after Mayon. It is known for its mystical cloud formations and the Japanese Garden within the Bicol Volcanological Park.',
            'location' => 'Sorsogon, Philippines',
            'latitude' => 12.7750,
            'longitude' => 124.1250,
            'category' => 'Volcano',
            'entry_fee' => 0,
            'contact_number' => '+63 56 456 7890',
            'basic_info' => '• Height: 1,565 meters\n• Active volcano with steam vents\n• Japanese Garden for photography\n• Nature treks and bird watching\n• Cool climate mountain destination',
            'is_active' => true,
        ]);

        $spot6 = TouristSpot::create([
            'name' => 'Pilar Sunflower Garden',
            'description' => 'A vast field of sunflowers in Pilar, Sorsogon. Best visited during the bloom season from January to March when thousands of sunflowers face the sun.',
            'location' => 'Pilar, Sorsogon',
            'latitude' => 12.9280,
            'longitude' => 123.6720,
            'category' => 'Nature',
            'entry_fee' => 30,
            'contact_number' => '+63 56 567 8901',
            'basic_info' => '• Best season: January to March\n• Thousands of sunflower blooms\n• Photography paradise\n• Picnic area available\n• Sunrise visits recommended',
            'is_active' => true,
        ]);

        $spot7 = TouristSpot::create([
            'name' => 'Escuela de Cristo',
            'description' => 'The Escuela de Cristo in Albay is a historic 17th-century Catholic prayer house. It is one of the oldest religious structures in the Bicol Region and features unique Spanish colonial architecture.',
            'location' => 'Albay, Philippines',
            'latitude' => 13.2100,
            'longitude' => 123.7350,
            'category' => 'Historical',
            'entry_fee' => 0,
            'contact_number' => '+63 52 678 9012',
            'basic_info' => '• Built in the 1600s\n• Spanish colonial architecture\n• Quiapo-style church design\n• Religious pilgrimage site\n• Historical significance to Bicol',
            'is_active' => true,
        ]);

        $spot8 = TouristSpot::create([
            'name' => 'Subic Beach',
            'description' => 'A pristine black sand beach in Sorsogon, perfect for swimming and beach camping. The dark volcanic sand contrasts beautifully with the blue waters.',
            'location' => 'Subic, Bacon, Sorsogon',
            'latitude' => 13.0200,
            'longitude' => 124.0500,
            'category' => 'Beach',
            'entry_fee' => 20,
            'contact_number' => '+63 56 789 0123',
            'basic_info' => '• Black volcanic sand beach\n• Crystal clear waters\n• Camping and bonfire areas\n• Less crowded than typical beaches\n• Near Bicol Volcanological Park',
            'is_active' => true,
        ]);

        $package1 = TourPackage::create([
            'name' => 'Mayon Volcano Explorer',
            'description' => 'Discover the beauty of Mayon Volcano and surrounding attractions. Visit the iconic Cagsawa Ruins and enjoy breathtaking views from Ligñon Hill.',
            'price' => 2500,
            'duration_days' => 2,
            'itinerary' => 'Day 1: Cagsawa Ruins, Ligñon Hill, ATV Adventure | Day 2: Mayon Summit Trek (optional)',
            'is_active' => true,
        ]);
        $package1->touristSpots()->attach([
            $spot1->id => ['day_number' => 1, 'order' => 1],
            $spot2->id => ['day_number' => 1, 'order' => 2],
        ]);

        $package2 = TourPackage::create([
            'name' => 'Bicol Adventure Tour',
            'description' => '3-day adventure exploring Bicol best spots - Mayon Volcano, Cagsawa Ruins, Donsol Whale Shark interaction, and more!',
            'price' => 5500,
            'duration_days' => 3,
            'itinerary' => 'Day 1: Mayon & Cagsawa | Day 2: Donsol Whale Shark | Day 3: Pilar Sunflower Garden',
            'is_active' => true,
        ]);
        $package2->touristSpots()->attach([
            $spot1->id => ['day_number' => 1, 'order' => 1],
            $spot2->id => ['day_number' => 2, 'order' => 2],
            $spot3->id => ['day_number' => 3, 'order' => 3],
        ]);

        $package3 = TourPackage::create([
            'name' => 'Sorsogon Nature Escape',
            'description' => 'Explore the natural wonders of Sorsogon - from whale sharks to volcanic landscapes and pristine beaches.',
            'price' => 4500,
            'duration_days' => 2,
            'itinerary' => 'Day 1: Donsol Whale Shark | Day 2: Mount Bulusan & Subic Beach',
            'is_active' => true,
        ]);
        $package3->touristSpots()->attach([
            $spot3->id => ['day_number' => 1, 'order' => 1],
            $spot5->id => ['day_number' => 2, 'order' => 2],
        ]);

        TourGuide::create([
            'name' => 'James Rodriguez',
            'email' => 'james@bicoltourism.com',
            'phone' => '+63 912 345 6789',
            'bio' => 'Experienced guide with 10 years in Bicol tourism. Expert in volcano tours and adventure activities.',
            'daily_rate' => 1500,
            'languages' => json_encode(['English', 'Filipino', 'Bicolano']),
            'is_available' => true,
        ]);

        TourGuide::create([
            'name' => 'Maria Santos',
            'email' => 'maria@bicoltourism.com',
            'phone' => '+63 921 234 5678',
            'bio' => 'Certified tour guide specializing in adventure tours and marine wildlife experiences.',
            'daily_rate' => 1200,
            'languages' => json_encode(['English', 'Filipino', 'Japanese']),
            'is_available' => true,
        ]);

        TourGuide::create([
            'name' => 'Roberto Martinez',
            'email' => 'roberto@bicoltourism.com',
            'phone' => '+63 931 456 7890',
            'bio' => 'Marine specialist and diving instructor. Expert in whale shark interactions and underwater tours.',
            'daily_rate' => 1800,
            'languages' => json_encode(['English', 'Filipino', 'Korean']),
            'is_available' => true,
        ]);

        Hotel::create([
            'name' => 'The Oriental Legazpi',
            'description' => 'Luxury hotel with stunning views of Mayon Volcano. World-class amenities and excellent service.',
            'address' => 'Washington Drive, Legazpi City',
            'latitude' => 13.1421,
            'longitude' => 123.7460,
            'contact_number' => '+63 52 480 0808',
            'email' => 'reservations@orientallegazpi.com',
            'price_per_night' => 4500,
            'rating' => '5-star',
            'is_active' => true,
        ]);

        Hotel::create([
            'name' => 'Casablanca Hotel',
            'description' => 'Affordable and comfortable stay in the heart of Legazpi City. Clean rooms and friendly service.',
            'address' => 'F. Imperial St., Legazpi City',
            'latitude' => 13.1380,
            'longitude' => 123.7380,
            'contact_number' => '+63 52 480 1234',
            'price_per_night' => 1500,
            'rating' => '3-star',
            'is_active' => true,
        ]);

        Hotel::create([
            'name' => 'Emerald Springs Hotel',
            'description' => 'Modern hotel with hot spring facilities. Relax and unwind after a day of exploring.',
            'address' => 'Sto. Domingo, Albay',
            'latitude' => 13.2150,
            'longitude' => 123.8100,
            'contact_number' => '+63 52 480 5678',
            'price_per_night' => 2500,
            'rating' => '4-star',
            'is_active' => true,
        ]);

        $shop1 = Shop::create([
            'name' => 'Bicol Souvenirs & Crafts',
            'description' => 'Local handicrafts, woven products, and authentic Bicol souvenirs. Support local artisans!',
            'address' => 'Central Market, Legazpi City',
            'latitude' => 13.1378,
            'longitude' => 123.7390,
            'contact_number' => '+63 52 234 5678',
            'type' => 'Gift Shop',
            'is_active' => true,
        ]);

        $shop2 = Shop::create([
            'name' => 'Cagsawa Craft Center',
            'description' => 'Handwoven products, local art, and Mayon-themed souvenirs. Unique gifts and memorabilia.',
            'address' => 'Cagsawa, Daraga, Albay',
            'latitude' => 13.1580,
            'longitude' => 123.7310,
            'contact_number' => '+63 52 345 6789',
            'type' => 'Art Gallery',
            'is_active' => true,
        ]);

        $shop3 = Shop::create([
            'name' => 'Silay Weaving Center',
            'description' => 'Traditional Bicolano weaving and textile products. Authentic abaca and pineapple fiber items.',
            'address' => 'Pilar, Sorsogon',
            'latitude' => 12.9290,
            'longitude' => 123.6730,
            'contact_number' => '+63 56 456 7890',
            'type' => 'Craft Shop',
            'is_active' => true,
        ]);

        Souvenir::create([
            'name' => 'Bicol Weave Tapestry',
            'description' => 'Handwoven abaca tapestry with traditional Bicolano patterns',
            'price' => 800,
            'shop_id' => $shop1->id,
            'is_active' => true,
        ]);

        Souvenir::create([
            'name' => 'Mayon Volcano Keychain',
            'description' => 'Miniature Mayon volcano replica as a memorable keepsake',
            'price' => 150,
            'shop_id' => $shop1->id,
            'is_active' => true,
        ]);

        Souvenir::create([
            'name' => 'Bicolano Mini Hat',
            'description' => 'Traditional Bicolano conical hat (salakay) - handwoven',
            'price' => 350,
            'shop_id' => $shop2->id,
            'is_active' => true,
        ]);

        Souvenir::create([
            'name' => 'Pili Nut Products',
            'description' => 'Local delicacy - Pili nut candies, cookies, and spreads',
            'price' => 200,
            'shop_id' => $shop1->id,
            'is_active' => true,
        ]);

        Restaurant::create([
            'name' => 'One Destination Restaurant',
            'description' => 'Famous restaurant serving authentic Bicolano cuisine. Try the spicy pork!',
            'address' => 'Brgy. 9, Cagsawa, Daraga, Albay',
            'latitude' => 13.1585,
            'longitude' => 123.7315,
            'contact_number' => '+63 52 456 7890',
            'cuisine_type' => 'Bicolano',
            'price_range' => 300,
            'rating' => '4.5',
            'is_active' => true,
        ]);

        Restaurant::create([
            'name' => 'Krustytask',
            'description' => 'Popular seafood restaurant near the airport. Fresh catches daily!',
            'address' => 'Airport Road, Legazpi City',
            'latitude' => 13.1290,
            'longitude' => 123.7350,
            'contact_number' => '+63 52 480 9000',
            'cuisine_type' => 'Seafood',
            'price_range' => 400,
            'rating' => '4.3',
            'is_active' => true,
        ]);

        Restaurant::create([
            'name' => 'Balay da Bato',
            'description' => 'Heritage restaurant with traditional Bicolano dishes and modern twist',
            'address' => 'F. Quan Zone, Legazpi City',
            'latitude' => 13.1400,
            'longitude' => 123.7420,
            'contact_number' => '+63 52 480 1234',
            'cuisine_type' => 'Filipino',
            'price_range' => 350,
            'rating' => '4.6',
            'is_active' => true,
        ]);

        Restaurant::create([
            'name' => 'Tierra de Maria Restaurant',
            'description' => 'Farm-to-table restaurant with organic ingredients and local flavors',
            'address' => 'Sto. Domingo, Albay',
            'latitude' => 13.2180,
            'longitude' => 123.8150,
            'contact_number' => '+63 52 480 5678',
            'cuisine_type' => 'Fusion',
            'price_range' => 450,
            'rating' => '4.4',
            'is_active' => true,
        ]);
    }
}