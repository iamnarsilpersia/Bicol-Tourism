@extends('layouts.admin')

@section('title', 'Edit Hotel')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Hotel</h1>

<form method="POST" action="{{ route('admin.hotels.update', $hotel->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    @csrf @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Hotel Name</label>
            <input type="text" name="name" value="{{ $hotel->name }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Contact Number</label>
            <input type="text" name="contact_number" value="{{ $hotel->contact_number }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Email</label>
            <input type="email" name="email" value="{{ $hotel->email }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Price per Night (₱)</label>
            <input type="number" step="0.01" name="price_per_night" value="{{ $hotel->price_per_night }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Rating</label>
            <select name="rating" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select Rating</option>
                <option value="1 Star" {{ $hotel->rating == '1 Star' ? 'selected' : '' }}>1 Star</option>
                <option value="2 Stars" {{ $hotel->rating == '2 Stars' ? 'selected' : '' }}>2 Stars</option>
                <option value="3 Stars" {{ $hotel->rating == '3 Stars' ? 'selected' : '' }}>3 Stars</option>
                <option value="4 Stars" {{ $hotel->rating == '4 Stars' ? 'selected' : '' }}>4 Stars</option>
                <option value="5 Stars" {{ $hotel->rating == '5 Stars' ? 'selected' : '' }}>5 Stars</option>
            </select>
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
            @if($hotel->image)
                <img src="{{ asset('storage/' . $hotel->image) }}" class="mt-2 h-20">
            @endif
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Address</label>
            <input type="text" name="address" value="{{ $hotel->address }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Latitude</label>
            <input type="number" step="any" name="latitude" value="{{ $hotel->latitude }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Longitude</label>
            <input type="number" step="any" name="longitude" value="{{ $hotel->longitude }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="3" class="w-full px-4 py-2 border rounded-lg">{{ $hotel->description }}</textarea>
        </div>
        
        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $hotel->is_active ? 'checked' : '' }} class="mr-2">
                <span>Active</span>
            </label>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Update Hotel</button>
        <a href="{{ route('admin.hotels') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
@endsection
