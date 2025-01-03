@extends('layouts.app')

@section('title', 'Book Room - Luxury Hotel')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Complete Your Booking</h2>

        <!-- Room Type Summary -->
        @include('bookings.partials.booking-summary')

        <!-- Price Calculation -->
        @include('bookings.partials.price-calculation')

        <!-- Booking Form -->
        @include('bookings.partials.booking-form')
    </div>
</div>
@endsection 