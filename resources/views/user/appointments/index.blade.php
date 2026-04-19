@extends('layouts.user')

@section('title', 'My Appointments')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">My Appointments</h1>
    <a href="{{ route('user.appointments.create') }}" class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900">New Appointment</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Title</th>
                <th class="px-6 py-3 text-left">Type</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($appointments as $appointment)
            <tr>
                <td class="px-6 py-4">{{ $appointment->title }}</td>
                <td class="px-6 py-4">{{ ucfirst($appointment->type) }}</td>
                <td class="px-6 py-4">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm 
                        @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800 mr-3">View</a>
                    @if($appointment->status == 'pending')
                        <form action="{{ route('user.appointments.cancel', $appointment->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Cancel</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $appointments->links() }}
</div>
@endsection
