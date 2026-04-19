@extends('layouts.admin')

@section('title', 'Add Souvenir - Admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Add New Souvenir</h1>

<form method="POST" action="{{ route('admin.souvenirs.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-2xl">
    @csrf
    
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Name</label>
        <input type="text" name="name" required class="w-full border rounded px-3 py-2">
    </div>
    
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Description</label>
        <textarea name="description" required class="w-full border rounded px-3 py-2" rows="3"></textarea>
    </div>
    
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Price</label>
        <input type="number" name="price" step="0.01" required class="w-full border rounded px-3 py-2">
    </div>
    
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Shop</label>
        <select name="shop_id" required class="w-full border rounded px-3 py-2">
            @foreach($shops as $shop)
            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Image</label>
        <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
    </div>
    
    <div class="flex space-x-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save</button>
        <a href="{{ route('admin.souvenirs') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
    </div>
</form>
@endsection