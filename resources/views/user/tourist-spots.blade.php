@extends('layouts.user')

@section('title', 'Tourist Spots')

@section('content')
<h1 class="text-3xl font-bold mb-6">Tourist Spots in Bicol</h1>

<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="{{ url('/user/tourist-spots') }}" method="GET">
        <div class="flex gap-4">
            <input type="text" name="search" placeholder="Search by name, location, or category..." value="{{ request()->input('search') }}" class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Search</button>
            @if(request()->input('search'))
            <a href="{{ url('/user/tourist-spots') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Clear</a>
            @endif
        </div>
    </form>
</div>

<div class="grid md:grid-cols-3 gap-6">
    @forelse($spots as $spot)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($spot->image)
            <img src="{{ asset('storage/' . $spot->image) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif
        <div class="p-4">
            <span class="px-2 py-1 rounded text-sm bg-blue-100 text-blue-800">{{ ucfirst($spot->category) }}</span>
            <h3 class="font-bold text-lg mt-2">{{ $spot->name }}</h3>
            <p class="text-gray-600 text-sm mb-2">📍 {{ $spot->location }}</p>
            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($spot->description, 100) }}</p>
            @if($spot->contact_number)
                <p class="text-sm mb-2">📱 {{ $spot->contact_number }}</p>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12">
        <p class="text-gray-500 text-lg">No tourist spots found matching your search.</p>
        <a href="{{ url('/user/tourist-spots') }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">View all spots</a>
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $spots->appends(request()->all())->links() }}
</div>
@endsection
