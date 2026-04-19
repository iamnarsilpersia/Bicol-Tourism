@extends('layouts.admin')

@section('title', 'Tour Packages')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Tour Packages</h1>
    <a href="{{ route('admin.tour-packages.create') }}" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add New Package</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($packages as $package)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($package->image)
            <img src="{{ asset('storage/' . $package->image) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif
        <div class="p-4">
            <h3 class="font-bold text-lg">{{ $package->name }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($package->description, 100) }}</p>
            <div class="flex justify-between items-center mb-2">
                <span class="text-blue-800 font-bold">₱{{ number_format($package->price, 2) }}</span>
                <span class="text-gray-500 text-sm">{{ $package->duration_days }} days</span>
            </div>
            <p class="text-sm text-gray-500 mb-2">Spots: {{ $package->touristSpots->count() }}</p>
            <div class="flex justify-between items-center">
                <span class="px-2 py-1 rounded text-sm {{ $package->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $package->is_active ? 'Active' : 'Inactive' }}
                </span>
                <div>
                    <a href="{{ route('admin.tour-packages.edit', $package->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form method="POST" action="{{ route('admin.tour-packages.destroy', $package->id) }}" class="inline">
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
    {{ $packages->links() }}
</div>
@endsection
