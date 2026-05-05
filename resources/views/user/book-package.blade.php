@extends('layouts.user')

@section('title', 'Book Tour Package')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Book: {{ $package->name }}</h1>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        @if($package->image)
            <img src="{{ asset('storage/' . $package->image) }}" class="w-full h-64 object-cover rounded-lg mb-4">
        @endif
        
        <div class="flex justify-between items-center mb-4">
            <span class="text-2xl font-bold text-blue-800">₱{{ number_format($package->price, 2) }}</span>
            <span class="text-gray-500">{{ $package->duration_days }} days</span>
        </div>
        
        <p class="text-gray-600 mb-4">{{ $package->description }}</p>
        
        <h3 class="font-bold mb-2">Itinerary:</h3>
        <div class="bg-gray-50 p-4 rounded-lg">
            {!! nl2br(e($package->itinerary)) !!}
        </div>
        
        <h3 class="font-bold mt-4 mb-2">Included Spots:</h3>
        <ul class="list-disc list-inside">
            @foreach($package->touristSpots as $spot)
            <li class="text-gray-600">{{ $spot->name }} - Day {{ $spot->pivot->day_number }}</li>
            @endforeach
        </ul>
    </div>

    <form method="POST" action="{{ route('user.reservations.store') }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        <input type="hidden" name="tour_package_id" value="{{ $package->id }}">
        
        <h2 class="text-xl font-bold mb-4">Reservation Details</h2>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Reservation Date</label>
            <input type="date" name="reservation_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Number of People</label>
            <input type="number" name="number_of_people" min="1" required class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Special Requests (Optional)</label>
            <textarea name="special_requests" rows="3" class="w-full px-4 py-2 border rounded-lg"></textarea>
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
            <p class="text-lg">Total Price: <span class="font-bold text-blue-800">₱{{ number_format($package->price, 2) }} x <span id="people-count">1</span> = ₱<span id="total-price">{{ number_format($package->price, 2) }}</span></span></p>
            <p class="text-sm text-gray-600 mt-2" id="downpayment-info"></p>
        </div>
        
        <button type="submit" class="w-full bg-blue-800 text-white py-3 rounded-lg hover:bg-blue-900 font-bold">Confirm Reservation</button>
    </form>
</div>

<script>
const price = {{ $package->price }};
const peopleInput = document.querySelector('input[name="number_of_people"]');
const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
const paymentModeSection = document.getElementById('payment-mode-section');
const downpaymentInfo = document.getElementById('downpayment-info');

function updatePrice() {
    const people = peopleInput.value || 1;
    document.getElementById('people-count').textContent = people;
    document.getElementById('total-price').textContent = (price * people).toLocaleString('en-PH', {minimumFractionDigits: 2});
    downpaymentInfo.textContent = 'Downpayment: ₱' + (price * people * 0.30).toLocaleString('en-PH', {minimumFractionDigits: 2});
}

peopleInput.addEventListener('input', updatePrice);

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
