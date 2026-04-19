@extends('layouts.admin')

@section('title', 'Edit Restaurant')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Restaurant</h1>

<form method="POST" action="{{ route('admin.restaurants.update', $restaurant->id) }}" class="bg-white rounded-lg shadow p-6" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Name</label>
            <input type="text" name="name" required value="{{ $restaurant->name }}" class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Cuisine Type</label>
            <input type="text" name="cuisine_type" value="{{ $restaurant->cuisine_type }}" class="w-full border rounded px-3 py-2">
        </div>
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Description</label>
        <textarea name="description" required class="w-full border rounded px-3 py-2" rows="3">{{ $restaurant->description }}</textarea>
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Address</label>
        <input type="text" name="address" required value="{{ $restaurant->address }}" class="w-full border rounded px-3 py-2">
    </div>
    
    <div class="grid md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Latitude</label>
            <input type="text" name="latitude" required value="{{ $restaurant->latitude }}" class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Longitude</label>
            <input type="text" name="longitude" required value="{{ $restaurant->longitude }}" class="w-full border rounded px-3 py-2">
        </div>
    </div>
    
    <div class="grid md:grid-cols-3 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Contact Number</label>
            <input type="text" name="contact_number" required value="{{ $restaurant->contact_number }}" class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Email</label>
            <input type="email" name="email" value="{{ $restaurant->email }}" class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Price Range (per person)</label>
            <input type="number" name="price_range" step="0.01" value="{{ $restaurant->price_range }}" class="w-full border rounded px-3 py-2">
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Rating</label>
            <input type="text" name="rating" value="{{ $restaurant->rating }}" class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
            @if($restaurant->image)
                <img src="{{ asset('storage/' . $restaurant->image) }}" class="mt-2 w-24 h-24 object-cover">
            @endif
        </div>
    </div>
    
    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update Restaurant</button>
    <a href="{{ route('admin.restaurants') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
</form>
@endsection