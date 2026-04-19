@extends('layouts.admin')

@section('title', 'Tourist Spots')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Tourist Spots</h1>
    <a href="{{ route('admin.tourist-spots.create') }}" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">Add New Spot</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Name</th>
                <th class="px-6 py-3 text-left">Location</th>
                <th class="px-6 py-3 text-left">Category</th>
                <th class="px-6 py-3 text-left">Contact</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($spots as $spot)
            <tr>
                <td class="px-6 py-4">{{ $spot->name }}</td>
                <td class="px-6 py-4">{{ $spot->location }}</td>
                <td class="px-6 py-4">{{ $spot->category }}</td>
                <td class="px-6 py-4">{{ $spot->contact_number ?? 'N/A' }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm {{ $spot->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $spot->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.tourist-spots.edit', $spot->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                    <form method="POST" action="{{ route('admin.tourist-spots.destroy', $spot->id) }}" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $spots->links() }}
</div>
@endsection
