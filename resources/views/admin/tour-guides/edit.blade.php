@extends('layouts.admin')

@section('title', 'Edit Tour Guide')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Tour Guide</h1>

<form method="POST" action="{{ route('admin.tour-guides.update', $guide->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    @csrf @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Name</label>
            <input type="text" name="name" value="{{ $guide->name }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Email</label>
            <input type="email" name="email" value="{{ $guide->email }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Phone</label>
            <input type="text" name="phone" value="{{ $guide->phone }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Daily Rate (₱)</label>
            <input type="number" step="0.01" name="daily_rate" value="{{ $guide->daily_rate }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Photo</label>
            <input type="file" name="photo" class="w-full px-4 py-2 border rounded-lg">
            @if($guide->photo)
                <img src="{{ asset('storage/' . $guide->photo) }}" class="mt-2 h-20">
            @endif
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Languages (comma separated)</label>
            <input type="text" name="languages_input" value="{{ implode(', ', $guide->languages ?? []) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Bio</label>
            <textarea name="bio" required rows="4" class="w-full px-4 py-2 border rounded-lg">{{ $guide->bio }}</textarea>
        </div>
        
        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_available" value="1" {{ $guide->is_available ? 'checked' : '' }} class="mr-2">
                <span>Available</span>
            </label>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Update Tour Guide</button>
        <a href="{{ route('admin.tour-guides') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
@endsection
