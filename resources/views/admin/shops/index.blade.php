@extends('layouts.admin')

@section('title', 'Shops')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Shops</h1>
    <a href="{{ route('admin.shops.create') }}" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add Shop</a>
</div>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($shops as $shop)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($shop->image)
            <img src="{{ asset('storage/' . $shop->image) }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif
        <div class="p-4">
            <h3 class="font-bold text-lg">{{ $shop->name }}</h3>
            <span class="px-2 py-1 rounded text-sm bg-purple-100 text-purple-800">{{ ucfirst($shop->type) }}</span>
            <p class="text-gray-600 text-sm mt-2 mb-2">{{ Str::limit($shop->description, 80) }}</p>
            <p class="text-sm mb-1">📍 {{ $shop->address }}</p>
            <p class="text-sm mb-1">📱 {{ $shop->contact_number }}</p>
            <div class="flex justify-between items-center mt-2">
                <span class="px-2 py-1 rounded text-sm {{ $shop->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $shop->is_active ? 'Active' : 'Inactive' }}
                </span>
                <div>
                    <a href="{{ route('admin.shops.edit', $shop->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <form method="POST" action="{{ route('admin.shops.destroy', $shop->id) }}" class="inline">
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
    {{ $shops->links() }}
</div>
@endsection
