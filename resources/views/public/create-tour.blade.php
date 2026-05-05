@extends('layouts.app')

@section('title', 'Book Custom Tour - Bicol Tourism')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-green-700 to-green-500 text-white py-12 mb-6">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-2">Book Your Custom Tour</h1>
        <p class="text-lg opacity-90">Create your perfect Bicol adventure</p>
    </div>
</div>

<div class="container mx-auto px-4 pb-12">
    <form method="POST" action="{{ route('public.book-tour.store') }}" class="bg-white rounded-xl shadow-lg p-8">
        @csrf
        
        <!-- Tour Details -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="bg-green-100 text-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                Tour Details
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tour Name</label>
                    <input type="text" name="tour_name" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="My Bicol Adventure">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tour Date</label>
                    <input type="date" name="tour_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Number of People</label>
                    <input type="number" name="number_of_people" required min="1" max="50" class="w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Tourist Spots -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                Select Tourist Spots
            </h2>
            <p class="text-gray-500 text-sm mb-4">Choose the destinations you want to visit</p>
            <div class="grid md:grid-cols-2 gap-4">
                @foreach($spots as $spot)
                <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                    <input type="checkbox" name="selected_spots[]" value="{{ $spot->id }}" class="mr-3 spot-checkbox" data-fee="{{ $spot->entry_fee ?? 0 }}" {{ $preselectedSpot == $spot->id ? 'checked' : '' }}>
                    <div class="inline-block">
                        <span class="font-bold text-gray-800">{{ $spot->name }}</span>
                        <span class="text-gray-500 text-sm block">{{ $spot->location }}</span>
                        @if($spot->entry_fee > 0)
                            <span class="text-green-600 text-sm">₱{{ number_format($spot->entry_fee, 2) }} entry fee</span>
                        @else
                            <span class="text-blue-600 text-sm">Free Entry</span>
                        @endif
                    </div>
                </label>
                @endforeach
            </div>
        </div>
        
        <!-- Food Options -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="bg-orange-100 text-orange-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                Select Food Options (Optional)
            </h2>
            <p class="text-gray-500 text-sm mb-4">Add meal packages from restaurants</p>
            <div class="grid md:grid-cols-2 gap-4">
                @foreach($restaurants as $restaurant)
                <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-orange-500 hover:bg-orange-50 transition">
                    <input type="checkbox" name="selected_foods[]" value="{{ $restaurant->id }}" class="mr-3 food-checkbox" data-price="{{ $restaurant->price_range ?? 0 }}">
                    <div class="inline-block">
                        <span class="font-bold text-gray-800">{{ $restaurant->name }}</span>
                        <span class="text-gray-500 text-sm block">{{ $restaurant->cuisine_type }}</span>
                        @if($restaurant->price_range)
                            <span class="text-green-600 text-sm">₱{{ number_format($restaurant->price_range, 0) }} per person</span>
                        @endif
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Payment Options -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="bg-purple-100 text-purple-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">4</span>
                Payment Options
            </h2>
            <div class="grid md:grid-cols-3 gap-4 mb-4">
                <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-green-500 hover:bg-green-50 transition payment-option">
                    <input type="radio" name="payment_method" value="full" class="mr-3" checked onchange="togglePaymentMode()">
                    <div class="inline-block">
                        <span class="font-bold text-gray-800">💰 Full Payment</span>
                        <span class="text-green-600 text-sm block">Pay the full amount now</span>
                        <span class="text-xs text-gray-500">Status: Confirmed immediately</span>
                    </div>
                </label>
                
                <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-yellow-500 hover:bg-yellow-50 transition payment-option">
                    <input type="radio" name="payment_method" value="downpayment" class="mr-3" onchange="togglePaymentMode()">
                    <div class="inline-block">
                        <span class="font-bold text-gray-800">💳 Downpayment (30%)</span>
                        <span class="text-yellow-600 text-sm block">Pay 30% to reserve</span>
                        <span class="text-xs text-gray-500">Status: Reserved</span>
                    </div>
                </label>
                
                <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition payment-option">
                    <input type="radio" name="payment_method" value="on_arrival" class="mr-3" onchange="togglePaymentMode()">
                    <div class="inline-block">
                        <span class="font-bold text-gray-800">🏨 Pay on Arrival</span>
                        <span class="text-blue-600 text-sm block">Pay when you arrive</span>
                        <span class="text-xs text-gray-500">Status: Pending confirmation</span>
                    </div>
                </label>
            </div>
            
            <!-- Payment Mode (shows for full or downpayment) -->
            <div id="payment-mode-section" class="bg-gray-50 p-6 rounded-xl">
                <h3 class="font-bold text-gray-800 mb-4">Select Payment Mode</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                        <input type="radio" name="payment_mode" value="gcash" class="mr-3" checked>
                        <div class="inline-block">
                            <span class="font-bold text-gray-800">📱 GCash</span>
                            <span class="text-gray-500 text-sm block">Instant transfer</span>
                        </div>
                    </label>
                    
                    <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition">
                        <input type="radio" name="payment_mode" value="paymaya" class="mr-3">
                        <div class="inline-block">
                            <span class="font-bold text-gray-800">📱 PayMaya</span>
                            <span class="text-gray-500 text-sm block">Instant transfer</span>
                        </div>
                    </label>
                    
                    <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
                        <input type="radio" name="payment_mode" value="landbank" class="mr-3">
                        <div class="inline-block">
                            <span class="font-bold text-gray-800">🏦 Landbank</span>
                            <span class="text-gray-500 text-sm block">Online banking</span>
                        </div>
                    </label>
                    
                    <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                        <input type="radio" name="payment_mode" value="bdo" class="mr-3">
                        <div class="inline-block">
                            <span class="font-bold text-gray-800">🏦 BD0</span>
                            <span class="text-gray-500 text-sm block">Online banking</span>
                        </div>
                    </label>
                    
                    <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-orange-500 hover:bg-orange-50 transition">
                        <input type="radio" name="payment_mode" value="unionbank" class="mr-3">
                        <div class="inline-block">
                            <span class="font-bold text-gray-800">🏦 UnionBank</span>
                            <span class="text-gray-500 text-sm block">Online banking</span>
                        </div>
                    </label>
                    
                    <label class="border-2 border-gray-200 p-4 rounded-xl cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
                        <input type="radio" name="payment_mode" value="cash" class="mr-3">
                        <div class="inline-block">
                            <span class="font-bold text-gray-800">💵 Cash</span>
                            <span class="text-gray-500 text-sm block">Pay at office</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Notes -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Special Requests / Notes</h2>
            <textarea name="notes" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent" rows="3" placeholder="Any special requests, dietary restrictions, etc..."></textarea>
        </div>
        
        <!-- Price Summary -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-xl mb-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4">Price Summary</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Tourist Spots: <span id="spots-total" class="font-semibold">₱0.00</span></p>
                    <p class="text-gray-600">Food Options: <span id="food-total" class="font-semibold">₱0.00</span></p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-green-600">Total: <span id="grand-total">₱0.00</span></p>
                    <p id="downpayment-display" class="text-yellow-600 font-medium hidden">Downpayment (30%): <span id="downpayment-amount">₱0.00</span></p>
                </div>
            </div>
        </div>
        
        <button type="submit" class="bg-green-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-green-700 w-full text-lg">
            ✅ Confirm Booking
        </button>
    </form>
</div>

@push('scripts')
<script>
    function togglePaymentMode() {
        var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        var paymentModeSection = document.getElementById('payment-mode-section');
        
        if (paymentMethod === 'on_arrival') {
            paymentModeSection.style.display = 'none';
            document.querySelectorAll('input[name="payment_mode"]').forEach(function(input) {
                input.removeAttribute('required');
            });
        } else {
            paymentModeSection.style.display = 'block';
            document.querySelectorAll('input[name="payment_mode"]').forEach(function(input) {
                input.setAttribute('required', 'required');
            });
        }
    }
    
    function calculateTotal() {
        var people = parseInt(document.querySelector('input[name="number_of_people"]').value) || 1;
        
        var spotsTotal = 0;
        document.querySelectorAll('.spot-checkbox:checked').forEach(function(cb) {
            spotsTotal += parseFloat(cb.dataset.fee);
        });
        
        var foodTotal = 0;
        document.querySelectorAll('.food-checkbox:checked').forEach(function(cb) {
            foodTotal += parseFloat(cb.dataset.price);
        });
        
        var total = (spotsTotal + foodTotal) * people;
        var downpayment = total * 0.30;
        
        document.getElementById('spots-total').textContent = '₱' + (spotsTotal * people).toLocaleString('en-PH', {minimumFractionDigits: 2});
        document.getElementById('food-total').textContent = '₱' + (foodTotal * people).toLocaleString('en-PH', {minimumFractionDigits: 2});
        document.getElementById('grand-total').textContent = '₱' + total.toLocaleString('en-PH', {minimumFractionDigits: 2});
        
        var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        var downpaymentDisplay = document.getElementById('downpayment-display');
        
        if (paymentMethod === 'downpayment') {
            downpaymentDisplay.classList.remove('hidden');
            document.getElementById('downpayment-amount').textContent = '₱' + downpayment.toLocaleString('en-PH', {minimumFractionDigits: 2});
        } else {
            downpaymentDisplay.classList.add('hidden');
        }
    }
    
    document.querySelectorAll('.spot-checkbox, .food-checkbox').forEach(function(cb) {
        cb.addEventListener('change', calculateTotal);
    });
    
    document.querySelector('input[name="number_of_people"]').addEventListener('input', calculateTotal);
    
    document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
        radio.addEventListener('change', calculateTotal);
    });
    
    // Initialize
    togglePaymentMode();
    
    // Auto-select preselected spot if any
    @if($preselectedSpot)
    var preselectedSpotId = {{ $preselectedSpot }};
    @else
    var preselectedSpotId = null;
    @endif
</script>
@endpush

@if($preselectedSpot)
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var checkbox = document.querySelector('.spot-checkbox[value="{{ $preselectedSpot }}"]');
    if (checkbox) {
        checkbox.closest('label').classList.add('border-blue-500', 'bg-blue-50');
        calculateTotal();
    }
});
</script>
@endpush
@endif
@endsection