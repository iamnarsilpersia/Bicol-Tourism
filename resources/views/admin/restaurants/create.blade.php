@extends('layouts.admin')

@section('title', 'Add Restaurant')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add New Restaurant</h1>

<form method="POST" action="{{ route('admin.restaurants.store') }}" class="bg-white rounded-lg shadow p-6" enctype="multipart/form-data">
    @csrf
    
    <div class="grid md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Name</label>
            <input type="text" name="name" required class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Cuisine Type</label>
            <input type="text" name="cuisine_type" class="w-full border rounded px-3 py-2" placeholder="e.g., Filipino, Seafood">
        </div>
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Description</label>
        <textarea name="description" required class="w-full border rounded px-3 py-2" rows="3"></textarea>
    </div>
    
    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Address</label>
        <input type="text" name="address" required class="w-full border rounded px-3 py-2">
    </div>
    
    <div class="grid md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Latitude</label>
            <input type="text" name="latitude" required class="w-full border rounded px-3 py-2" placeholder="e.g., 13.444">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Longitude</label>
            <input type="text" name="longitude" required class="w-full border rounded px-3 py-2" placeholder="e.g., 123.75">
        </div>
    </div>
    
    <div class="grid md:grid-cols-3 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Contact Number</label>
            <input type="text" name="contact_number" required class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Price Range (per person)</label>
            <input type="number" name="price_range" step="0.01" class="w-full border rounded px-3 py-2" placeholder="0.00">
        </div>
    </div>
    
    <div class="grid md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Rating</label>
            <input type="text" name="rating" class="w-full border rounded px-3 py-2" placeholder="e.g., 4.5">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>
    </div>
    
    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Save Restaurant</button>
    <a href="{{ route('admin.restaurants') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
</form>
@endsection