@extends('layouts.admin')

@section('title', 'Souvenirs - Admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Souvenirs</h1>
    <a href="{{ route('admin.souvenirs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Souvenir</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Shop</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($souvenirs as $souvenir)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $souvenir->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $souvenir->shop->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">₱{{ number_format($souvenir->price, 2) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded {{ $souvenir->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $souvenir->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                    <form method="POST" action="{{ route('admin.souvenirs.destroy', $souvenir->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this souvenir?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No souvenirs found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $souvenirs->links() }}
@endsection