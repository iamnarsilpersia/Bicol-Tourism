<?php

namespace App\Http\Controllers;

use App\Models\TouristSpot;
use App\Models\Hotel;
use App\Models\Shop;
use App\Models\Restaurant;
use App\Models\Souvenir;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $spots = TouristSpot::where('is_active', true)->take(6)->get();
        $packages = TourPackage::where('is_active', true)->take(3)->get();
        return view('welcome', compact('spots', 'packages'));
    }

    public function touristSpots()
    {
        $spots = TouristSpot::where('is_active', true)->orderBy('name')->paginate(12);
        return view('public.tourist-spots', compact('spots'));
    }

    public function touristSpotDetail($id)
    {
        $spot = TouristSpot::findOrFail($id);
        return view('public.tourist-spot-detail', compact('spot'));
    }

    public function tourPackages()
    {
        $packages = TourPackage::with('touristSpots')->where('is_active', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('public.tour-packages', compact('packages'));
    }

    public function map()
    {
        $touristSpots = TouristSpot::where('is_active', true)->get();
        $hotels = Hotel::where('is_active', true)->get();
        $shops = Shop::where('is_active', true)->get();
        $restaurants = Restaurant::where('is_active', true)->get();
        return view('public.map', compact('touristSpots', 'hotels', 'shops', 'restaurants'));
    }

    public function nearbyPlaces(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius ?? 10;

        function calculateDistance($lat1, $lng1, $lat2, $lng2) {
            $earthRadius = 6371;
            $dLat = deg2rad($lat2 - $lat1);
            $dLng = deg2rad($lng2 - $lng1);
            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng/2) * sin($dLng/2);
            $c = 2 * atan2(sqrt($a), sqrt(1-$a));
            return $earthRadius * $c;
        }

        $hotels = Hotel::where('is_active', true)->get()->filter(function($hotel) use ($lat, $lng, $radius, &$calculateDistance) {
            $distance = calculateDistance($lat, $lng, $hotel->latitude, $hotel->longitude);
            $hotel->distance = round($distance, 1);
            return $distance < $radius;
        })->sortBy('distance')->values();

        $shops = Shop::where('is_active', true)->get()->filter(function($shop) use ($lat, $lng, $radius) {
            $distance = calculateDistance($lat, $lng, $shop->latitude, $shop->longitude);
            $shop->distance = round($distance, 1);
            return $distance < $radius;
        })->sortBy('distance')->values();

        $restaurants = Restaurant::where('is_active', true)->get()->filter(function($restaurant) use ($lat, $lng, $radius) {
            $distance = calculateDistance($lat, $lng, $restaurant->latitude, $restaurant->longitude);
            $restaurant->distance = round($distance, 1);
            return $distance < $radius;
        })->sortBy('distance')->values();

        $souvenirs = Souvenir::where('is_active', true)->with('shop')->get();

        return view('public.nearby-places', compact('hotels', 'shops', 'restaurants', 'souvenirs', 'lat', 'lng', 'radius'));
    }
}
