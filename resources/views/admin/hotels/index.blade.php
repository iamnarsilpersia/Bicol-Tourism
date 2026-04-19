@extends('layouts.admin')

@section('title', 'Hotels')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Hotels</h1>
    <a href="{{ route('admin.hotels.create') }}" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add Hotel</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($hotels as $hotel)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($hotel->image)
            <img src="{{ asset('storage/' . $hotel->image) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif
        <div class="p-4">
            <h3 class="font-bold text-lg">{{ $hotel->name }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($hotel->description, 80) }}</p>
            <p class="text-sm mb-1">📍 {{ $hotel->address }}</p>
            <p class="text-sm mb-1">📱 {{ $hotel->contact_number }}</p>
            <p class="text-blue-800 font-bold">₱{{ number_format($hotel->price_per_night, 2) }}/night</p>
            <div class="flex justify-between items-center mt-2">
                <span class="px-2 py-1 rounded text-sm {{ $hotel->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $hotel->is_active ? 'Active' : 'Inactive' }}
                </span>
                <div>
                    <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form method="POST" action="{{ route('admin.hotels.destroy', $hotel->id) }}" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $hotels->links() }}
</div>
@endsection
