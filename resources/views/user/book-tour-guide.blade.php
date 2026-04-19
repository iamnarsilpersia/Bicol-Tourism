@extends('layouts.user')

@section('title', 'Book Tour Guide')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Book: {{ $guide->name }}</h1>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        @if($guide->photo)
            <img src="{{ asset('storage/' . $guide->photo) }}" class="w-32 h-32 object-cover rounded-full mx-auto mb-4">
        @endif
        
        <div class="text-center">
            <h2 class="text-xl font-bold">{{ $guide->name }}</h2>
            <p class="text-gray-600">{{ $guide->bio }}</p>
            <p class="text-sm mt-2">📧 {{ $guide->email }}</p>
            <p class="text-sm">📱 {{ $guide->phone }}</p>
            <p class="text-sm mt-2">Languages: {{ implode(', ', $guide->languages ?? ['Not specified']) }}</p>
            <p class="text-blue-800 font-bold text-2xl mt-4">₱{{ number_format($guide->daily_rate, 2) }}/day</p>
        </div>
    </div>

    <form method="POST" action="{{ route('user.tour-guide-bookings.store') }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        <input type="hidden" name="tour_guide_id" value="{{ $guide->id }}">
        
        <h2 class="text-xl font-bold mb-4">Booking Details</h2>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Start Date</label>
            <input type="date" name="booking_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Number of Days</label>
            <input type="number" name="days" min="1" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Notes (Optional)</label>
            <textarea name="notes" rows="3" class="w-full px-4 py-2 border rounded-lg" placeholder="Any special requests or requirements..."></textarea>
        </div>
        
        <button type="submit" class="w-full bg-blue-800 text-white py-3 rounded-lg hover:bg-blue-900 font-bold">Confirm Booking</button>
    </form>
</div>
@endsection
