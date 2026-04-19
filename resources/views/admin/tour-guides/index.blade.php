@extends('layouts.admin')

@section('title', 'Tour Guides')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Tour Guides</h1>
    <a href="{{ route('admin.tour-guides.create') }}" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add Tour Guide</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($guides as $guide)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($guide->photo)
            <img src="{{ asset('storage/' . $guide->photo) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Photo</span>
            </div>
        @endif
        <div class="p-4">
            <h3 class="font-bold text-lg">{{ $guide->name }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($guide->bio, 80) }}</p>
            <p class="text-sm mb-2">📧 {{ $guide->email }}</p>
            <p class="text-sm mb-2">📱 {{ $guide->phone }}</p>
            <p class="text-blue-800 font-bold mb-2">₱{{ number_format($guide->daily_rate, 2) }}/day</p>
            <p class="text-sm text-gray-500 mb-2">Languages: {{ implode(', ', $guide->languages ?? []) }}</p>
            <div class="flex justify-between items-center">
                <span class="px-2 py-1 rounded text-sm {{ $guide->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $guide->is_available ? 'Available' : 'Unavailable' }}
                </span>
                <div>
                    <a href="{{ route('admin.tour-guides.edit', $guide->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form method="POST" action="{{ route('admin.tour-guides.destroy', $guide->id) }}" class="inline">
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
    {{ $guides->links() }}
</div>
@endsection
