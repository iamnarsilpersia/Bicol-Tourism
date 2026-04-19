@extends('layouts.admin')

@section('title', 'Restaurants')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Restaurants</h1>
    <a href="{{ route('admin.restaurants.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Restaurant</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Address</th>
                <th class="px-6 py-3 text-left">Cuisine</th>
                <th class="px-6 py-3 text-left">Price Range</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurants as $restaurant)
            <tr class="border-t">
                <td class="px-6 py-4">{{ $restaurant->name }}</td>
                <td class="px-6 py-4">{{ $restaurant->address }}</td>
                <td class="px-6 py-4">{{ $restaurant->cuisine_type }}</td>
                <td class="px-6 py-4">₱{{ number_format($restaurant->price_range, 0) }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                    <form method="POST" action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $restaurants->links() }}
</div>
@endsection