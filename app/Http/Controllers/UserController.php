<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\TouristSpot;
use App\Models\Hotel;
use App\Models\Shop;
use App\Models\Restaurant;
use App\Models\Souvenir;
use App\Models\TourGuide;
use App\Models\Appointment;
use App\Models\TourGuideBooking;
use App\Models\Reservation;
use App\Models\CustomTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $myReservations = Reservation::where('user_id', $user->id)->with('tourPackage')->get();
        $myAppointments = Appointment::where('user_id', $user->id)->orderBy('appointment_date', 'desc')->get();
        $myGuideBookings = TourGuideBooking::where('user_id', $user->id)->with('tourGuide')->get();
        $myCustomTours = CustomTour::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('user.dashboard', compact('myReservations', 'myAppointments', 'myGuideBookings', 'myCustomTours'));
    }

    public function touristSpots(Request $request)
    {
        $query = TouristSpot::where('is_active', true);
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%');
            });
        }
        
        $spots = $query->orderBy('name')->paginate(12);
        return view('user.tourist-spots', compact('spots'));
    }

    public function tourPackages()
    {
        $packages = TourPackage::with('touristSpots')->where('is_active', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('user.tour-packages', compact('packages'));
    }

    public function bookPackage($id)
    {
        $package = TourPackage::with('touristSpots')->findOrFail($id);
        return view('user.book-package', compact('package'));
    }

    public function storeReservation(Request $request)
    {
        $request->validate([
            'tour_package_id' => 'required|exists:tour_packages,id',
            'reservation_date' => 'required|date|after:today',
            'number_of_people' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
            'payment_method' => 'required|in:full,downpayment,on_arrival',
            'payment_mode' => 'required_if:payment_method,full,downpayment|nullable|in:gcash,paymaya,landbank,bdo,unionbank,cash',
        ]);

        $package = TourPackage::findOrFail($request->tour_package_id);
        $totalPrice = $package->price * $request->number_of_people;
        $downpaymentAmount = 0;
        $paymentStatus = 'unpaid';
        $status = 'pending';

        if ($request->payment_method === 'full') {
            $paymentStatus = 'paid';
            $status = 'confirmed';
            $downpaymentAmount = $totalPrice;
        } elseif ($request->payment_method === 'downpayment') {
            $downpaymentAmount = $totalPrice * 0.30;
            $paymentStatus = 'partial';
            $status = 'pending';
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'tour_package_id' => $request->tour_package_id,
            'reservation_date' => $request->reservation_date,
            'number_of_people' => $request->number_of_people,
            'special_requests' => $request->special_requests,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'payment_mode' => $request->payment_method === 'on_arrival' ? null : $request->payment_mode,
            'downpayment_amount' => $downpaymentAmount,
            'payment_status' => $paymentStatus,
            'status' => $status,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Reservation submitted successfully!');
    }

    public function tourGuides()
    {
        $guides = TourGuide::where('is_available', true)->orderBy('name')->paginate(10);
        return view('user.tour-guides', compact('guides'));
    }

    public function bookTourGuide($id)
    {
        $guide = TourGuide::findOrFail($id);
        return view('user.book-tour-guide', compact('guide'));
    }

    public function storeTourGuideBooking(Request $request)
    {
        $request->validate([
            'tour_guide_id' => 'required|exists:tour_guides,id',
            'booking_date' => 'required|date|after:today',
            'days' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:full,downpayment,on_arrival',
            'payment_mode' => 'required_if:payment_method,full,downpayment|nullable|in:gcash,paymaya,landbank,bdo,unionbank,cash',
        ]);

        $guide = TourGuide::findOrFail($request->tour_guide_id);
        $totalAmount = $guide->daily_rate * $request->days;
        $downpaymentAmount = 0;
        $paymentStatus = 'unpaid';
        $status = 'pending';

        if ($request->payment_method === 'full') {
            $paymentStatus = 'paid';
            $status = 'confirmed';
            $downpaymentAmount = $totalAmount;
        } elseif ($request->payment_method === 'downpayment') {
            $downpaymentAmount = $totalAmount * 0.30;
            $paymentStatus = 'partial';
            $status = 'pending';
        }

        TourGuideBooking::create([
            'user_id' => Auth::id(),
            'tour_guide_id' => $request->tour_guide_id,
            'booking_date' => $request->booking_date,
            'days' => $request->days,
            'total_amount' => $totalAmount,
            'status' => $status,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method,
            'payment_mode' => $request->payment_method === 'on_arrival' ? null : $request->payment_mode,
            'downpayment_amount' => $downpaymentAmount,
            'payment_status' => $paymentStatus,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Tour guide booking submitted successfully!');
    }

    public function createAppointment()
    {
        return view('user.appointments.create');
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'appointment_date' => 'required|date|after:now',
            'type' => 'required|in:consultation,booking,inquiry,other',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'appointment_date' => $request->appointment_date,
            'type' => $request->type,
            'status' => 'pending',
        ]);

        return redirect()->route('user.appointments.index')->with('success', 'Appointment scheduled successfully!');
    }

    public function appointments()
    {
        $appointments = Appointment::where('user_id', Auth::id())->orderBy('appointment_date', 'desc')->paginate(10);
        return view('user.appointments.index', compact('appointments'));
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())->findOrFail($id);
        
        if ($appointment->status === 'pending') {
            $appointment->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Appointment cancelled.');
        }

        return redirect()->back()->with('error', 'Cannot cancel this appointment.');
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())->findOrFail($id);
        
        if ($reservation->status === 'pending') {
            $reservation->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Reservation cancelled.');
        }

        return redirect()->back()->with('error', 'Cannot cancel this reservation.');
    }

    public function cancelGuideBooking($id)
    {
        $booking = TourGuideBooking::where('user_id', Auth::id())->findOrFail($id);
        
        if ($booking->status === 'pending') {
            $booking->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Tour guide booking cancelled.');
        }

        return redirect()->back()->with('error', 'Cannot cancel this booking.');
    }

    public function cancelCustomTour($id)
    {
        $tour = CustomTour::where('user_id', Auth::id())->findOrFail($id);
        
        if ($tour->status === 'pending') {
            $tour->update(['status' => 'cancelled']);
            return redirect()->back()->with('success', 'Custom tour cancelled.');
        }

        return redirect()->back()->with('error', 'Cannot cancel this booking. It has already been approved.');
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

        $souvenirs = Souvenir::where('is_active', true)->with('shop')->get();

        return view('user.nearby-places', compact('hotels', 'shops', 'souvenirs', 'lat', 'lng'));
    }

    public function mapView()
    {
        $touristSpots = TouristSpot::where('is_active', true)->get();
        return view('user.map', compact('touristSpots'));
    }
}
