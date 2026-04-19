@extends('layouts.admin')

@section('title', 'Edit Shop')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Shop</h1>

<form method="POST" action="{{ route('admin.shops.update', $shop->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    @csrf @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Shop Name</label>
            <input type="text" name="name" value="{{ $shop->name }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Type</label>
            <select name="type" required class="w-full px-4 py-2 border rounded-lg">
                <option value="souvenir" {{ $shop->type == 'souvenir' ? 'selected' : '' }}>Souvenir Shop</option>
                <option value="restaurant" {{ $shop->type == 'restaurant' ? 'selected' : '' }}>Restaurant</option>
                <option value="shop" {{ $shop->type == 'shop' ? 'selected' : '' }}>General Shop</option>
            </select>
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Contact Number</label>
            <input type="text" name="contact_number" value="{{ $shop->contact_number }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
            @if($shop->image)
                <img src="{{ asset('storage/' . $shop->image) }}" class="mt-2 h-20">
            @endif
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Address</label>
            <input type="text" name="address" value="{{ $shop->address }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Latitude</label>
            <input type="number" step="any" name="latitude" value="{{ $shop->latitude }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Longitude</label>
            <input type="number" step="any" name="longitude" value="{{ $shop->longitude }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="3" class="w-full px-4 py-2 border rounded-lg">{{ $shop->description }}</textarea>
        </div>
        
        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $shop->is_active ? 'checked' : '' }} class="mr-2">
                <span>Active</span>
            </label>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Update Shop</button>
        <a href="{{ route('admin.shops') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
@endsection
