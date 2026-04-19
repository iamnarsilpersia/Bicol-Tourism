@extends('layouts.admin')

@section('title', 'Create Tour Guide')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add Tour Guide</h1>

<form method="POST" action="{{ route('admin.tour-guides.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    @csrf
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Name</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Phone</label>
            <input type="text" name="phone" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Daily Rate (₱)</label>
            <input type="number" step="0.01" name="daily_rate" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Photo</label>
            <input type="file" name="photo" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Languages (comma separated)</label>
            <input type="text" name="languages_input" placeholder="English, Filipino, Bicol" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Bio</label>
            <textarea name="bio" required rows="4" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
        
        <div>
            <label class="flex items-center">
                <input type="checkbox" name="is_available" value="1" checked class="mr-2">
                <span>Available</span>
            </label>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Save Tour Guide</button>
        <a href="{{ route('admin.tour-guides') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
@endsection
