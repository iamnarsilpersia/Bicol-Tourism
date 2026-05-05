<?php

namespace App\Http\Controllers;

use App\Models\TouristSpot;
use App\Models\Restaurant;
use App\Models\CustomTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function createTour(Request $request)
    {
        $spots = TouristSpot::where('is_active', true)->get();
        $restaurants = Restaurant::where('is_active', true)->get();
        $preselectedSpot = $request->spot_id ? $request->spot_id : null;
        return view('public.create-tour', compact('spots', 'restaurants', 'preselectedSpot'));
    }

    public function storeTour(Request $request)
    {
        $request->validate([
            'tour_name' => 'required|string|max:255',
            'tour_date' => 'required|date|after:today',
            'number_of_people' => 'required|integer|min:1|max:50',
            'selected_spots' => 'required|array|min:1',
            'selected_foods' => 'nullable|array',
            'payment_method' => 'required|in:full,downpayment,on_arrival',
            'payment_mode' => 'required_if:payment_method,full,downpayment|nullable|in:gcash,paymaya,landbank,bdo,unionbank,cash',
            'notes' => 'nullable|string',
        ]);

        $spots = TouristSpot::whereIn('id', $request->selected_spots)->get();
        $spotsTotal = $spots->sum('entry_fee') * $request->number_of_people;

        $foodTotal = 0;
        if ($request->selected_foods) {
            $restaurants = Restaurant::whereIn('id', $request->selected_foods)->get();
            $foodTotal = $restaurants->sum('price_range') * $request->number_of_people;
        }

        $totalPrice = $spotsTotal + $foodTotal;
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
            $status = 'reserved';
        } elseif ($request->payment_method === 'on_arrival') {
            $downpaymentAmount = 0;
            $paymentStatus = 'unpaid';
            $status = 'pending';
        }

        $customTour = CustomTour::create([
            'user_id' => Auth::id(),
            'tour_name' => $request->tour_name,
            'tour_date' => $request->tour_date,
            'number_of_people' => $request->number_of_people,
            'selected_spots' => $request->selected_spots,
            'selected_foods' => $request->selected_foods ?? [],
            'spots_total' => $spotsTotal,
            'food_total' => $foodTotal,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'payment_mode' => $request->payment_method === 'on_arrival' ? null : $request->payment_mode,
            'downpayment_amount' => $downpaymentAmount,
            'payment_status' => $paymentStatus,
            'notes' => $request->notes,
            'status' => $status,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Tour booked successfully! Status: ' . ucfirst($status));
    }
}