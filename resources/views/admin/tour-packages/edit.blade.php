@extends('layouts.admin')

@section('title', 'Edit Tour Package')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Tour Package</h1>

<form method="POST" action="{{ route('admin.tour-packages.update', $package->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    @csrf @method('PUT')
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Package Name</label>
            <input type="text" name="name" value="{{ $package->name }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Price (₱)</label>
            <input type="number" step="0.01" name="price" value="{{ $package->price }}" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Duration (Days)</label>
            <input type="number" name="duration_days" value="{{ $package->duration_days }}" min="1" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
            @if($package->image)
                <img src="{{ asset('storage/' . $package->image) }}" class="mt-2 h-20">
            @endif
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="3" class="w-full px-4 py-2 border rounded-lg">{{ $package->description }}</textarea>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Itinerary</label>
            <textarea name="itinerary" required rows="5" class="w-full px-4 py-2 border rounded-lg">{{ $package->itinerary }}</textarea>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Select Tourist Spots</label>
            <div class="border rounded-lg p-4 max-h-60 overflow-y-auto">
                @php $selectedSpots = $package->touristSpots->pluck('id')->toArray(); @endphp
                @foreach($spots as $spot)
                <label class="flex items-center mb-2">
                    <input type="checkbox" name="spot_ids[]" value="{{ $spot->id }}" class="mr-2 spot-checkbox" {{ in_array($spot->id, $selectedSpots) ? 'checked' : '' }}>
                    <span>{{ $spot->name }} ({{ $spot->location }})</span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="mt-6">
        <label class="flex items-center mb-4">
            <input type="checkbox" name="is_active" value="1" {{ $package->is_active ? 'checked' : '' }} class="mr-2">
            <span>Active</span>
        </label>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Update Package</button>
        <a href="{{ route('admin.tour-packages') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>
@endsection
