@extends('layouts.app')

@section('title', 'Booking Confirmation - Luxury Hotel')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-8 text-center">
        <div class="mb-6">
            <svg class="mx-auto h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Booking Successful!</h2>
        <p class="text-gray-600 mb-6">Thank you for choosing Luxury Hotel. Your booking has been confirmed.</p>
        <a 
            href="{{ url('/') }}" 
            class="inline-block bg-indigo-600 text-white rounded-md py-2 px-6 hover:bg-indigo-700 transition duration-150 ease-in-out"
        >
            Return to Homepage
        </a>
    </div>
</div>
@endsection 