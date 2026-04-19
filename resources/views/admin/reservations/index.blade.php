@extends('layouts.admin')

@section('title', 'Reservations')

@section('content')
<h1 class="text-2xl font-bold mb-6">Reservations</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">ID</th>
                <th class="px-6 py-3 text-left">User</th>
                <th class="px-6 py-3 text-left">Package</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">People</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($reservations as $reservation)
            <tr>
                <td class="px-6 py-4">{{ $reservation->id }}</td>
                <td class="px-6 py-4">{{ $reservation->user->name }}</td>
                <td class="px-6 py-4">{{ $reservation->tourPackage->name }}</td>
                <td class="px-6 py-4">{{ $reservation->reservation_date->format('M d, Y') }}</td>
                <td class="px-6 py-4">{{ $reservation->number_of_people }}</td>
                <td class="px-6 py-4">₱{{ number_format($reservation->total_price, 2) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm 
                        @if($reservation->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($reservation->status == 'confirmed') bg-blue-100 text-blue-800
                        @elseif($reservation->status == 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('admin.reservations.update-status', $reservation->id) }}" method="POST" class="inline">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="text-sm border rounded px-2 py-1">
                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $reservations->links() }}
</div>
@endsection
