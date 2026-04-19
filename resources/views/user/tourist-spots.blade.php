@extends('layouts.user')

@section('title', 'Tourist Spots')

@section('content')
<h1 class="text-3xl font-bold mb-6">Tourist Spots in Bicol</h1>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($spots as $spot)
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
    @endforeach
</div>

<div class="mt-6">
    {{ $spots->links() }}
</div>
@endsection
