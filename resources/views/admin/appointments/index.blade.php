@extends('layouts.admin')

@section('title', 'Appointments - Admin')

@section('content')
<h1 class="text-3xl font-bold mb-6">Appointments</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($appointments as $appointment)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($appointment->type) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded 
                        @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($appointment->status === 'confirmed') bg-green-100 text-green-800
                        @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                        @else bg-blue-100 text-blue-800 @endif">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form method="POST" action="{{ route('admin.appointments.update-status', $appointment->id) }}" class="inline-flex items-center space-x-2">
                        @csrf
                        <select name="status" class="border rounded px-2 py-1 text-sm">
                            <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="text-blue-600 hover:text-blue-900">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No appointments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $appointments->links() }}
@endsection