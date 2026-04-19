@extends('layouts.admin')

@section('title', 'Create Hotel')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add Hotel</h1>

<form method="POST" action="{{ route('admin.hotels.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    @csrf
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Hotel Name</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Contact Number</label>
            <input type="text" name="contact_number" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Price per Night (₱)</label>
            <input type="number" step="0.01" name="price_per_night" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Rating</label>
            <select name="rating" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select Rating</option>
                <option value="1 Star">1 Star</option>
                <option value="2 Stars">2 Stars</option>
                <option value="3 Stars">3 Stars</option>
                <option value="4 Stars">4 Stars</option>
                <option value="5 Stars">5 Stars</option>
            </select>
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Address</label>
            <input type="text" name="address" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Latitude</label>
            <input type="number" step="any" name="latitude" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Longitude</label>
            <input type="number" step="any" name="longitude" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Save Hotel</button>
        <a href="{{ route('admin.hotels') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
@endsection
