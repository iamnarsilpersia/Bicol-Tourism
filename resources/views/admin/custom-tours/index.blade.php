@extends('layouts.admin')

@section('title', 'Custom Tours')

@section('content')
<h1 class="text-2xl font-bold mb-6">Custom Tour Bookings</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Tour Name</th>
                <th class="px-6 py-3 text-left">User</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">People</th>
                <th class="px-6 py-3 text-left">Total</th>
                <th class="px-6 py-3 text-left">Payment</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tours as $tour)
            <tr class="border-t">
                <td class="px-6 py-4">
                    <div class="font-semibold">{{ $tour->tour_name }}</div>
                    <div class="text-xs text-gray-500">{{ $tour->number_of_people }} people</div>
                </td>
                <td class="px-6 py-4">{{ $tour->user->name ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($tour->tour_date)->format('M d, Y') }}</td>
                <td class="px-6 py-4">₱{{ number_format($tour->total_price, 2) }}</td>
                <td class="px-6 py-4">
                    <div class="text-xs">
                        <span class="@if($tour->payment_method == 'full') text-green-600 @elseif($tour->payment_method == 'downpayment') text-yellow-600 @else text-gray-600 @endif">
                            @if($tour->payment_method == 'full') Full Payment
                            @elseif($tour->payment_method == 'downpayment') Downpayment
                            @else Pay on Arrival @endif
                        </span>
                        @if($tour->payment_mode)
                        <span class="block text-gray-500">{{ strtoupper($tour->payment_mode) }}</span>
                        @endif
                        <span class="block @if($tour->payment_status == 'paid') text-green-500 @elseif($tour->payment_status == 'partial') text-yellow-500 @else text-red-500 @endif">
                            @if($tour->payment_status == 'paid') ✅ Paid
                            @elseif($tour->payment_status == 'partial') 💰 Partial ({{ number_format($tour->downpayment_amount, 2) }})
                            @else ⏳ Unpaid @endif
                        </span>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-sm 
                        @if($tour->status == 'confirmed') bg-green-100 text-green-800
                        @elseif($tour->status == 'reserved') bg-blue-100 text-blue-800
                        @elseif($tour->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        @if($tour->status == 'confirmed') Confirmed (Paid)
                        @elseif($tour->status == 'reserved') Reserved (Partial)
                        @elseif($tour->status == 'cancelled') Cancelled
                        @else Pending @endif
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($tour->status == 'pending')
                    <form method="POST" action="{{ route('admin.custom-tours.update-status', $tour->id) }}" class="inline">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                            <option value="pending" {{ $tour->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $tour->status == 'confirmed' ? 'selected' : '' }}>✅ Approve</option>
                            <option value="cancelled" {{ $tour->status == 'cancelled' ? 'selected' : '' }}>❌ Decline</option>
                        </select>
                    </form>
                    @else
                    <span class="text-gray-500">
                        @if($tour->status == 'confirmed') ✅ Approved
                        @elseif($tour->status == 'cancelled') ❌ Declined
                        @endif
                    </span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $tours->links() }}
</div>
@endsection