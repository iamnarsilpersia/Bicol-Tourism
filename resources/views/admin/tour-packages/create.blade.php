@extends('layouts.admin')

@section('title', 'Create Tour Package')

@section('content')
<h1 class="text-2xl font-bold mb-6">Create Tour Package</h1>

<form method="POST" action="{{ route('admin.tour-packages.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
    @csrf
    
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-700 mb-2">Package Name</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Price (₱)</label>
            <input type="number" step="0.01" name="price" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Duration (Days)</label>
            <input type="number" name="duration_days" min="1" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div>
            <label class="block text-gray-700 mb-2">Image</label>
            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Itinerary</label>
            <textarea name="itinerary" required rows="5" class="w-full px-4 py-2 border rounded-lg" placeholder="Day 1: ...&#10;Day 2: ..."></textarea>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Select Tourist Spots</label>
            <div class="border rounded-lg p-4 max-h-60 overflow-y-auto">
                @foreach($spots as $spot)
                <label class="flex items-center mb-2">
                    <input type="checkbox" name="spot_ids[]" value="{{ $spot->id }}" class="mr-2 spot-checkbox">
                    <span>{{ $spot->name }} ({{ $spot->location }})</span>
                </label>
                @endforeach
            </div>
        </div>
        
        <div class="md:col-span-2">
            <label class="block text-gray-700 mb-2">Day Numbers (in order)</label>
            <div id="day-numbers"></div>
        </div>
    </div>
    
    <div class="mt-6">
        <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Save Package</button>
        <a href="{{ route('admin.tour-packages') }}" class="ml-4 text-gray-600 hover:text-gray-800">Cancel</a>
    </div>
</form>

<script>
document.querySelectorAll('.spot-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const container = document.getElementById('day-numbers');
        container.innerHTML = '';
        let dayNumber = 1;
        let currentDay = 1;
        document.querySelectorAll('.spot-checkbox:checked').forEach((cb, index) => {
            if (index > 0 && index % 3 === 0) dayNumber++;
            container.innerHTML += `
                <div class="flex items-center mb-2">
                    <span class="w-48">${cb.nextElementSibling.textContent}</span>
                    <input type="number" name="day_numbers[]" value="${dayNumber}" min="1" class="px-2 py-1 border rounded w-20">
                </div>
            `;
        });
    });
});
</script>
@endsection
