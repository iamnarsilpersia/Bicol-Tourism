@extends('layouts.user')

@section('title', 'Tour Guides')

@section('content')
<h1 class="text-3xl font-bold mb-6">Book a Tour Guide</h1>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($guides as $guide)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($guide->photo)
            <img src="{{ asset('storage/' . $guide->photo) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Photo</span>
            </div>
        @endif
        <div class="p-4">
            <h3 class="font-bold text-lg">{{ $guide->name }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($guide->bio, 80) }}</p>
            <p class="text-sm mb-1">📧 {{ $guide->email }}</p>
            <p class="text-sm mb-2">📱 {{ $guide->phone }}</p>
            <p class="text-sm mb-2">🗣️ {{ implode(', ', $guide->languages ?? ['Not specified']) }}</p>
            <p class="text-blue-800 font-bold text-xl mb-4">₱{{ number_format($guide->daily_rate, 2) }}/day</p>
            <a href="{{ route('user.book-tour-guide', $guide->id) }}" class="block text-center bg-blue-800 text-white py-2 rounded hover:bg-blue-900">Book Now</a>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $guides->links() }}
</div>
@endsection
