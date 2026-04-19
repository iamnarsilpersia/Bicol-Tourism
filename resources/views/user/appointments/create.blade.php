@extends('layouts.user')

@section('title', 'Create Appointment')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Schedule an Appointment</h1>

    <form method="POST" action="{{ route('user.appointments.store') }}" class="bg-white rounded-lg shadow p-6">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Title</label>
            <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg" placeholder="e.g., Tour Inquiry, Booking Discussion">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Type</label>
            <select name="type" required class="w-full px-4 py-2 border rounded-lg">
                <option value="inquiry">Inquiry</option>
                <option value="consultation">Consultation</option>
                <option value="booking">Booking Discussion</option>
                <option value="other">Other</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Appointment Date & Time</label>
            <input type="datetime-local" name="appointment_date" required min="{{ date('Y-m-d\TH:i') }}" class="w-full px-4 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Description</label>
            <textarea name="description" required rows="5" class="w-full px-4 py-2 border rounded-lg" placeholder="Please describe what you would like to discuss..."></textarea>
        </div>
        
        <div class="flex justify-between">
            <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-gray-800">Cancel</a>
            <button type="submit" class="bg-blue-800 text-white px-6 py-2 rounded hover:bg-blue-900">Schedule Appointment</button>
        </div>
    </form>
</div>
@endsection
