@extends('layouts.user')

@section('title', 'Tour Packages')

@section('content')
<h1 class="text-3xl font-bold mb-6">Tour Packages</h1>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($packages as $package)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($package->image)
            <img src="{{ asset('storage/' . $package->image) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif
        <div class="p-4">
            <h3 class="font-bold text-lg">{{ $package->name }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($package->description, 80) }}</p>
            <div class="flex justify-between items-center mb-2">
                <span class="text-blue-800 font-bold text-xl">₱{{ number_format($package->price, 2) }}</span>
                <span class="text-gray-500 text-sm">{{ $package->duration_days }} days</span>
            </div>
            <p class="text-sm text-gray-500 mb-3">Includes: {{ $package->touristSpots->count() }} tourist spots</p>
            <a href="{{ route('user.book-package', $package->id) }}" class="block text-center bg-blue-800 text-white py-2 rounded hover:bg-blue-900">Book Now</a>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $packages->links() }}
</div>
@endsection
