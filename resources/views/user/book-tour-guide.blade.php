@extends('layouts.user')

@section('title', 'Book Tour Guide')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Book: {{ $guide->name }}</h1>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        @if($guide->photo)
            <img src="{{ asset('storage/' . $guide->photo) }}" class="w-32 h-32 object-cover rounded-full mx-auto mb-4">
        @endif
        
        <div class="text-center">
            <h2 class="text-xl font-bold">{{ $guide->name }}</h2>
            <p class="text-gray-600">{{ $guide->bio }}</p>
            <p class="text-sm mt-2">📧 {{ $guide->email }}</p>
            <p class="text-sm">📱 {{ $guide->phone }}</p>
            <p class="text-sm mt-2">Languages: {{ implode(', ', $guide->languages ?? ['Not specified']) }}</p>
            <p class="text-blue-800 font-bold text-2xl mt-4">₱{{ number_format($guide->daily_rate, 2) }}/day</p>
        </div>
    </div>

    <form method="POST" action="{{ route('user.tour-guide-bookings.store') }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        <input type="hidden" name="tour_guide_id" value="{{ $guide->id }}">
        
        <h2 class="text-xl font-bold mb-4">Booking Details</h2>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Start Date</label>
            <input type="date" name="booking_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Number of Days</label>
            <input type="number" name="days" id="days" min="1" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Notes (Optional)</label>
            <textarea name="notes" rows="3" class="w-full px-4 py-2 border rounded-lg" placeholder="Any special requests or requirements..."></textarea>
        </div>

        <h2 class="text-xl font-bold mb-4 mt-6">Payment Method</h2>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Select Payment Option</label>
            <div class="space-y-2">
                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="downpayment" required class="mr-3">
                    <div>
                        <span class="font-semibold">Downpayment (30%)</span>
                        <p class="text-sm text-gray-500">Pay 30% now, balance on arrival</p>
                    </div>
                </label>
                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="payment_method" value="on_arrival" class="mr-3">
                    <div>
                        <span class="font-semibold">Pay on Arrival</span>
                        <p class="text-sm text-gray-500">Pay full amount when you arrive</p>
                    </div>
                </label>
            </div>
        </div>

        <div id="payment-mode-section" class="mb-4 hidden">
            <label class="block text-gray-700 mb-2">Payment Mode</label>
            <select name="payment_mode" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select Payment Mode</option>
                <option value="gcash">GCash</option>
                <option value="paymaya">PayMaya</option>
                <option value="landbank">Landbank</option>
                <option value="bdo">BDO</option>
                <option value="unionbank">UnionBank</option>
                <option value="cash">Cash</option>
            </select>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg mb-6">
            <p class="text-lg">Total Amount: <span class="font-bold text-blue-800">₱{{ number_format($guide->daily_rate, 2) }} x <span id="days-count">1</span> = ₱<span id="total-price">{{ number_format($guide->daily_rate, 2) }}</span></span></p>
            <p class="text-sm text-gray-600 mt-2" id="downpayment-info"></p>
        </div>
        
        <button type="submit" class="w-full bg-blue-800 text-white py-3 rounded-lg hover:bg-blue-900 font-bold">Confirm Booking</button>
    </form>
</div>

<script>
const dailyRate = {{ $guide->daily_rate }};
const daysInput = document.getElementById('days');
const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
const paymentModeSection = document.getElementById('payment-mode-section');
const downpaymentInfo = document.getElementById('downpayment-info');

function updatePrice() {
    const days = daysInput.value || 1;
    document.getElementById('days-count').textContent = days;
    document.getElementById('total-price').textContent = (dailyRate * days).toLocaleString('en-PH', {minimumFractionDigits: 2});
    downpaymentInfo.textContent = 'Downpayment: ₱' + (dailyRate * days * 0.30).toLocaleString('en-PH', {minimumFractionDigits: 2});
}

daysInput.addEventListener('input', updatePrice);

paymentRadios.forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.value === 'downpayment') {
            paymentModeSection.classList.remove('hidden');
            downpaymentInfo.classList.remove('hidden');
        } else {
            paymentModeSection.classList.add('hidden');
            downpaymentInfo.classList.add('hidden');
        }
    });
});

updatePrice();
</script>
@endsection
