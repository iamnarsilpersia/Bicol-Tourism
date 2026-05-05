@extends('layouts.user')

@section('title', 'User Dashboard')

@section('content')
<h1 class="text-3xl font-bold mb-8">Welcome, {{ Auth::user()->name }}!</h1>

<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">My Reservations</h3>
        <p class="text-3xl font-bold">{{ $myReservations->count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">My Appointments</h3>
        <p class="text-3xl font-bold">{{ $myAppointments->count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Tour Guide Bookings</h3>
        <p class="text-3xl font-bold">{{ $myGuideBookings->count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500">Custom Tours</h3>
        <p class="text-3xl font-bold">{{ $myCustomTours->count() }}</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">My Reservations</h2>
            <a href="{{ route('user.tour-packages') }}" class="text-blue-600 hover:text-blue-800">Book New</a>
        </div>
        @forelse($myReservations->take(5) as $reservation)
        <div class="border-b py-3">
            <div class="flex justify-between">
                <span class="font-semibold">{{ $reservation->tourPackage->name }}</span>
                <span class="px-2 py-1 rounded text-sm 
                    @if($reservation->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($reservation->status == 'confirmed') bg-blue-100 text-blue-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst($reservation->status) }}
                </span>
            </div>
            <p class="text-sm text-gray-600">{{ $reservation->reservation_date->format('M d, Y') }} - {{ $reservation->number_of_people }} people</p>
            <p class="text-sm">
                <span class="font-bold">₱{{ number_format($reservation->total_price, 2) }}</span>
                @if($reservation->payment_method == 'full')
                    <span class="ml-2 text-green-600">| Full Payment via {{ strtoupper($reservation->payment_mode) }}</span>
                @elseif($reservation->payment_method == 'downpayment')
                    <span class="ml-2 text-yellow-600">| Downpayment: ₱{{ number_format($reservation->downpayment_amount, 2) }}</span>
                @else
                    <span class="ml-2 text-gray-500">| Pay on Arrival</span>
                @endif
                <span class="ml-2 px-2 py-0.5 rounded text-xs
                    @if($reservation->payment_status == 'paid') bg-green-200 text-green-800
                    @elseif($reservation->payment_status == 'partial') bg-yellow-200 text-yellow-800
                    @else bg-gray-200 text-gray-800 @endif">
                    @if($reservation->payment_status == 'paid') Paid
                    @elseif($reservation->payment_status == 'partial') Partial
                    @else Unpaid @endif
                </span>
            </p>
            @if($reservation->status == 'pending')
                <form action="{{ route('user.reservations.cancel', $reservation->id) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Cancel</button>
                </form>
            @endif
        </div>
        @empty
        <p class="text-gray-500">No reservations yet.</p>
        @endforelse
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">My Appointments</h2>
            <a href="{{ route('user.appointments.create') }}" class="text-blue-600 hover:text-blue-800">New Appointment</a>
        </div>
        @forelse($myAppointments->take(5) as $appointment)
        <div class="border-b py-3">
            <div class="flex justify-between">
                <span class="font-semibold">{{ $appointment->title }}</span>
                <span class="px-2 py-1 rounded text-sm 
                    @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst($appointment->status) }}
                </span>
            </div>
            <p class="text-sm text-gray-600">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</p>
            @if($appointment->status == 'pending')
                <form action="{{ route('user.appointments.cancel', $appointment->id) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Cancel</button>
                </form>
            @endif
        </div>
        @empty
        <p class="text-gray-500">No appointments yet.</p>
        @endforelse
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Tour Guide Bookings</h2>
        <a href="{{ route('user.tour-guides') }}" class="text-blue-600 hover:text-blue-800">Book Guide</a>
    </div>
    @forelse($myGuideBookings->take(5) as $booking)
    <div class="border-b py-3">
        <div class="flex justify-between">
            <span class="font-semibold">{{ $booking->tourGuide->name }}</span>
            <span class="px-2 py-1 rounded text-sm 
                @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-800
                @else bg-red-100 text-red-800 @endif">
                {{ ucfirst($booking->status) }}
            </span>
        </div>
        <p class="text-sm text-gray-600">{{ $booking->booking_date->format('M d, Y') }} - {{ $booking->days }} days</p>
        <p class="text-sm">
            <span class="font-bold">₱{{ number_format($booking->total_amount, 2) }}</span>
            @if($booking->payment_method == 'full')
                <span class="ml-2 text-green-600">| Full Payment via {{ strtoupper($booking->payment_mode) }}</span>
            @elseif($booking->payment_method == 'downpayment')
                <span class="ml-2 text-yellow-600">| Downpayment: ₱{{ number_format($booking->downpayment_amount, 2) }}</span>
            @else
                <span class="ml-2 text-gray-500">| Pay on Arrival</span>
            @endif
            <span class="ml-2 px-2 py-0.5 rounded text-xs
                @if($booking->payment_status == 'paid') bg-green-200 text-green-800
                @elseif($booking->payment_status == 'partial') bg-yellow-200 text-yellow-800
                @else bg-gray-200 text-gray-800 @endif">
                @if($booking->payment_status == 'paid') Paid
                @elseif($booking->payment_status == 'partial') Partial
                @else Unpaid @endif
            </span>
        </p>
        @if($booking->status == 'pending')
            <form action="{{ route('user.tour-guide-bookings.cancel', $booking->id) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:text-red-800">Cancel</button>
            </form>
        @endif
    </div>
    @empty
    <p class="text-gray-500">No tour guide bookings yet.</p>
    @endforelse
</div>

<div class="bg-white rounded-lg shadow p-6 mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Custom Tours</h2>
        <a href="{{ route('public.book-tour') }}" class="text-blue-600 hover:text-blue-800">Book New Tour</a>
    </div>
@forelse($myCustomTours->take(5) as $tour)
    <div class="border-b py-3">
        <div class="flex justify-between items-center">
            <span class="font-semibold">{{ $tour->tour_name }}</span>
            <div class="flex items-center space-x-2">
                <span class="px-2 py-1 rounded text-sm 
                    @if($tour->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($tour->status == 'confirmed') bg-green-100 text-green-800
                    @elseif($tour->status == 'reserved') bg-blue-100 text-blue-800
                    @elseif($tour->status == 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($tour->status) }}
                </span>
                <span class="px-2 py-1 rounded text-xs
                    @if($tour->payment_status == 'paid') bg-green-200 text-green-800
                    @elseif($tour->payment_status == 'partial') bg-yellow-200 text-yellow-800
                    @else bg-gray-200 text-gray-800 @endif">
                    @if($tour->payment_status == 'paid') Paid
                    @elseif($tour->payment_status == 'partial') Partial
                    @else Unpaid @endif
                </span>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-1">{{ \Carbon\Carbon::parse($tour->tour_date)->format('M d, Y') }} - {{ $tour->number_of_people }} people</p>
        <p class="text-sm text-gray-600">
            <span class="text-green-600 font-bold">Total: ₱{{ number_format($tour->total_price, 2) }}</span>
            @if($tour->payment_method == 'full')
                <span class="ml-2 text-blue-600">| Full Payment via {{ strtoupper($tour->payment_mode) }}</span>
            @elseif($tour->payment_method == 'downpayment')
                <span class="ml-2 text-yellow-600">| Downpayment: ₱{{ number_format($tour->downpayment_amount, 2) }} ({{ strtoupper($tour->payment_mode) }})</span>
            @else
                <span class="ml-2 text-gray-500">| Pay on Arrival</span>
            @endif
        </p>
        
        @if($tour->payment_method == 'downpayment' && ($tour->payment_status == 'partial' || $tour->status == 'reserved'))
            <div class="mt-2 p-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800 font-medium">💰 Balance to pay on arrival: <strong>₱{{ number_format($tour->total_price - $tour->downpayment_amount, 2) }}</strong></p>
            </div>
        @endif
        
        @if($tour->payment_method == 'on_arrival' && $tour->status == 'pending')
            <form action="{{ route('user.custom-tours.cancel', $tour->id) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Are you sure you want to cancel this booking?')">
                    ❌ Cancel Booking
                </button>
            </form>
        @endif
    </div>
    @empty
    <p class="text-gray-500">No custom tours yet. <a href="{{ route('public.book-tour') }}" class="text-blue-600">Book your first tour!</a></p>
    @endforelse
</div>
@endsection
