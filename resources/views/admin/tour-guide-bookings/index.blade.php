@extends('layouts.admin')

@section('title', 'Tour Guide Bookings')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tour Guide Bookings</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">ID</th>
                <th class="px-6 py-3 text-left">User</th>
                <th class="px-6 py-3 text-left">Guide</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Days</th>
                <th class="px-6 py-3 text-left">Payment</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach($bookings as $booking)
            <tr>
                <td class="px-6 py-4">{{ $booking->id }}</td>
                <td class="px-6 py-4">{{ $booking->user->name }}</td>
                <td class="px-6 py-4">{{ $booking->tourGuide->name }}</td>
                <td class="px-6 py-4">{{ $booking->booking_date->format('M d, Y') }}</td>
                <td class="px-6 py-4">{{ $booking->days }}</td>
                <td class="px-6 py-4">
                    <div class="text-xs">
                        <span class="@if($booking->payment_method == 'full') text-green-600 @elseif($booking->payment_method == 'downpayment') text-yellow-600 @else text-gray-600 @endif">
                            @if($booking->payment_method == 'full') Full Payment
                            @elseif($booking->payment_method == 'downpayment') Downpayment
                            @else Pay on Arrival @endif
                        </span>
                        @if($booking->payment_mode)
                        <span class="block text-gray-500">{{ strtoupper($booking->payment_mode) }}</span>
                        @endif
                        <span class="block @if($booking->payment_status == 'paid') text-green-500 @elseif($booking->payment_status == 'partial') text-yellow-500 @else text-red-500 @endif">
                            @if($booking->payment_status == 'paid') Paid
                            @elseif($booking->payment_status == 'partial') Partial (₱{{ number_format($booking->downpayment_amount, 2) }})
                            @else Unpaid @endif
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4">₱{{ number_format($booking->total_amount, 2) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm 
                        @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status == 'confirmed') bg-blue-100 text-blue-800
                        @elseif($booking->status == 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @php
                        $paymentMethod = $booking->payment_method ?? 'on_arrival';
                        $canTakeAction = in_array($paymentMethod, ['on_arrival', 'downpayment']) || $paymentMethod === null;
                    @endphp
                    @if($canTakeAction && ($booking->status == 'pending' || $booking->status == 'confirmed'))
                        <form action="{{ route('admin.tour-guide-bookings.update-status', $booking->id) }}" method="POST" class="inline">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="text-sm border rounded px-2 py-1">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Approve</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Decline</option>
                            </select>
                        </form>
                    @elseif($booking->status == 'pending')
                        <form action="{{ route('admin.tour-guide-bookings.update-status', $booking->id) }}" method="POST" class="inline">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="text-sm border rounded px-2 py-1">
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Approve</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Decline</option>
                            </select>
                        </form>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $bookings->links() }}
</div>
@endsection