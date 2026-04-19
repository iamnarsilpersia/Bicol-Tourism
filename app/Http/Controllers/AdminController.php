<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Shop;
use App\Models\Souvenir;
use App\Models\Restaurant;
use App\Models\CustomTour;
use App\Models\TourPackage;
use App\Models\TouristSpot;
use App\Models\Reservation;
use App\Models\TourGuide;
use App\Models\TourGuideBooking;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'tourist_spots' => TouristSpot::count(),
            'tour_packages' => TourPackage::count(),
            'reservations' => Reservation::count(),
            'tour_guides' => TourGuide::count(),
            'hotels' => Hotel::count(),
            'shops' => Shop::count(),
            'restaurants' => Restaurant::count(),
            'custom_tours' => CustomTour::count(),
            'appointments' => Appointment::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function touristSpots()
    {
        $spots = TouristSpot::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tourist-spots.index', compact('spots'));
    }

    public function createTouristSpot()
    {
        return view('admin.tourist-spots.create');
    }

    public function storeTouristSpot(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'category' => 'required|string|max:100',
            'contact_number' => 'nullable|string|max:20',
            'basic_info' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tourist-spots', 'public');
        }

        TouristSpot::create($data);

        return redirect()->route('admin.tourist-spots')->with('success', 'Tourist spot created successfully.');
    }

    public function editTouristSpot($id)
    {
        $spot = TouristSpot::findOrFail($id);
        return view('admin.tourist-spots.edit', compact('spot'));
    }

    public function updateTouristSpot(Request $request, $id)
    {
        $spot = TouristSpot::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'category' => 'required|string|max:100',
            'contact_number' => 'nullable|string|max:20',
            'basic_info' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tourist-spots', 'public');
        }

        $spot->update($data);

        return redirect()->route('admin.tourist-spots')->with('success', 'Tourist spot updated successfully.');
    }

    public function destroyTouristSpot($id)
    {
        $spot = TouristSpot::findOrFail($id);
        $spot->delete();

        return redirect()->route('admin.tourist-spots')->with('success', 'Tourist spot deleted successfully.');
    }

    public function tourPackages()
    {
        $packages = TourPackage::with('touristSpots')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tour-packages.index', compact('packages'));
    }

    public function createTourPackage()
    {
        $spots = TouristSpot::where('is_active', true)->get();
        return view('admin.tour-packages.create', compact('spots'));
    }

    public function storeTourPackage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'itinerary' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'spot_ids' => 'required|array',
        ]);

        $data = $request->except('spot_ids');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        $package = TourPackage::create($data);

        foreach ($request->spot_ids as $index => $spotId) {
            $package->touristSpots()->attach($spotId, [
                'day_number' => $request->day_numbers[$index] ?? 1,
                'order' => $index + 1,
            ]);
        }

        return redirect()->route('admin.tour-packages')->with('success', 'Tour package created successfully.');
    }

    public function editTourPackage($id)
    {
        $package = TourPackage::with('touristSpots')->findOrFail($id);
        $spots = TouristSpot::where('is_active', true)->get();
        return view('admin.tour-packages.edit', compact('package', 'spots'));
    }

    public function updateTourPackage(Request $request, $id)
    {
        $package = TourPackage::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'itinerary' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'spot_ids' => 'required|array',
        ]);

        $data = $request->except('spot_ids');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($data);
        $package->touristSpots()->detach();

        foreach ($request->spot_ids as $index => $spotId) {
            $package->touristSpots()->attach($spotId, [
                'day_number' => $request->day_numbers[$index] ?? 1,
                'order' => $index + 1,
            ]);
        }

        return redirect()->route('admin.tour-packages')->with('success', 'Tour package updated successfully.');
    }

    public function destroyTourPackage($id)
    {
        $package = TourPackage::findOrFail($id);
        $package->touristSpots()->detach();
        $package->delete();

        return redirect()->route('admin.tour-packages')->with('success', 'Tour package deleted successfully.');
    }

    public function reservations()
    {
        $reservations = Reservation::with(['user', 'tourPackage'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateReservationStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Reservation status updated.');
    }

    public function tourGuides()
    {
        $guides = TourGuide::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tour-guides.index', compact('guides'));
    }

    public function createTourGuide()
    {
        return view('admin.tour-guides.create');
    }

    public function storeTourGuide(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'bio' => 'required',
            'daily_rate' => 'required|numeric|min:0',
            'languages' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('tour-guides', 'public');
        }

        TourGuide::create($data);

        return redirect()->route('admin.tour-guides')->with('success', 'Tour guide created successfully.');
    }

    public function editTourGuide($id)
    {
        $guide = TourGuide::findOrFail($id);
        return view('admin.tour-guides.edit', compact('guide'));
    }

    public function updateTourGuide(Request $request, $id)
    {
        $guide = TourGuide::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'bio' => 'required',
            'daily_rate' => 'required|numeric|min:0',
            'languages' => 'nullable|array',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('tour-guides', 'public');
        }

        $guide->update($data);

        return redirect()->route('admin.tour-guides')->with('success', 'Tour guide updated successfully.');
    }

    public function destroyTourGuide($id)
    {
        $guide = TourGuide::findOrFail($id);
        $guide->delete();

        return redirect()->route('admin.tour-guides')->with('success', 'Tour guide deleted successfully.');
    }

    public function tourGuideBookings()
    {
        $bookings = TourGuideBooking::with(['user', 'tourGuide'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tour-guide-bookings.index', compact('bookings'));
    }

    public function updateTourGuideBookingStatus(Request $request, $id)
    {
        $booking = TourGuideBooking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Booking status updated.');
    }

    public function hotels()
    {
        $hotels = Hotel::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function createHotel()
    {
        return view('admin.hotels.create');
    }

    public function storeHotel(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email',
            'price_per_night' => 'required|numeric|min:0',
            'rating' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        Hotel::create($data);

        return redirect()->route('admin.hotels')->with('success', 'Hotel created successfully.');
    }

    public function editHotel($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function updateHotel(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email',
            'price_per_night' => 'required|numeric|min:0',
            'rating' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($data);

        return redirect()->route('admin.hotels')->with('success', 'Hotel updated successfully.');
    }

    public function destroyHotel($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return redirect()->route('admin.hotels')->with('success', 'Hotel deleted successfully.');
    }

    public function shops()
    {
        $shops = Shop::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.shops.index', compact('shops'));
    }

    public function createShop()
    {
        return view('admin.shops.create');
    }

    public function storeShop(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'required|string|max:20',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shops', 'public');
        }

        Shop::create($data);

        return redirect()->route('admin.shops')->with('success', 'Shop created successfully.');
    }

    public function editShop($id)
    {
        $shop = Shop::findOrFail($id);
        return view('admin.shops.edit', compact('shop'));
    }

    public function updateShop(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'required|string|max:20',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('shops', 'public');
        }

        $shop->update($data);

        return redirect()->route('admin.shops')->with('success', 'Shop updated successfully.');
    }

    public function destroyShop($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('admin.shops')->with('success', 'Shop deleted successfully.');
    }

    public function souvenirs()
    {
        $souvenirs = Souvenir::with('shop')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.souvenirs.index', compact('souvenirs'));
    }

    public function createSouvenir()
    {
        $shops = Shop::where('is_active', true)->get();
        return view('admin.souvenirs.create', compact('shops'));
    }

    public function storeSouvenir(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'shop_id' => 'required|exists:shops,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('souvenirs', 'public');
        }

        Souvenir::create($data);

        return redirect()->route('admin.souvenirs')->with('success', 'Souvenir created successfully.');
    }

    public function appointments()
    {
        $appointments = Appointment::with('user')->orderBy('appointment_date', 'desc')->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->back()->with('success', 'Appointment status updated.');
    }

    public function mapView()
    {
        $touristSpots = TouristSpot::where('is_active', true)->get();
        $hotels = Hotel::where('is_active', true)->get();
        $shops = Shop::where('is_active', true)->get();
        $restaurants = Restaurant::where('is_active', true)->get();
        
        return view('admin.map.index', compact('touristSpots', 'hotels', 'shops', 'restaurants'));
    }

    public function nearbyPlaces(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius ?? 5;

        $hotels = Hotel::where('is_active', true)
            ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        $shops = Shop::where('is_active', true)
            ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        $restaurants = Restaurant::where('is_active', true)
            ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        $souvenirs = Souvenir::where('is_active', true)->with('shop')->get();

        return response()->json([
            'hotels' => $hotels,
            'shops' => $shops,
            'restaurants' => $restaurants,
            'souvenirs' => $souvenirs,
        ]);
    }

    public function restaurants()
    {
        $restaurants = Restaurant::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function createRestaurant()
    {
        return view('admin.restaurants.create');
    }

    public function storeRestaurant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email',
            'cuisine_type' => 'nullable|string|max:100',
            'price_range' => 'nullable|numeric|min:0',
            'rating' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('restaurants', 'public');
        }

        Restaurant::create($data);

        return redirect()->route('admin.restaurants')->with('success', 'Restaurant created successfully.');
    }

    public function editRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    public function updateRestaurant(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_number' => 'required|string|max:20',
            'email' => 'nullable|email',
            'cuisine_type' => 'nullable|string|max:100',
            'price_range' => 'nullable|numeric|min:0',
            'rating' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('restaurants', 'public');
        }

        $restaurant->update($data);

        return redirect()->route('admin.restaurants')->with('success', 'Restaurant updated successfully.');
    }

    public function destroyRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('admin.restaurants')->with('success', 'Restaurant deleted successfully.');
    }

    public function customTours()
    {
        $tours = CustomTour::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.custom-tours.index', compact('tours'));
    }

    public function updateCustomTourStatus(Request $request, $id)
    {
        $tour = CustomTour::findOrFail($id);
        $tour->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Tour status updated.');
    }
}
