@extends('layouts.app')

@section('title', 'Available Rooms - Luxury Hotel')

@section('content')
<div class="bg-white/95 backdrop-blur-sm rounded-lg shadow-xl p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Available Room Types</h2>
    
    <!-- Search Parameters Summary -->
    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
        <p class="text-gray-600">
            Searching for {{ $guests }} {{ Str::plural('guest', $guests) }} •
            {{ \Carbon\Carbon::parse($check_in)->format('M d, Y') }} to 
            {{ \Carbon\Carbon::parse($check_out)->format('M d, Y') }}
        </p>
    </div>

    <!-- Room Types Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($roomTypes as $roomType)
            <div class="border rounded-lg overflow-hidden shadow-md">
                <div class="aspect-[3/2] w-full">
                    <img 
                        src="{{ $roomType->getThumbnailUrl() }}" 
                        alt="{{ $roomType->name }}"
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="p-6">
                    <!-- Room type content... -->
                    @include('rooms.partials.room-type-card')
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <h3 class="text-xl font-medium text-gray-900 mb-2">No Available Rooms</h3>
                <p class="text-gray-600">Sorry, we couldn't find any room types matching your criteria.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection 