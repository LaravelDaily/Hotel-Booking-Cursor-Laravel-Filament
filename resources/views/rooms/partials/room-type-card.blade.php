<div class="flex justify-between items-start mb-4">
    <h3 class="text-xl font-semibold text-gray-800">{{ $roomType->name }}</h3>
    <p class="text-lg font-semibold text-indigo-600">${{ number_format($roomType->price_per_night, 2) }}/night</p>
</div>

<div class="mb-4">
    <h4 class="text-sm font-medium text-gray-700 mb-2">Room Details:</h4>
    <div class="flex gap-4 text-sm text-gray-600 mb-3">
        <span>{{ $roomType->size }} m² </span>
        <span>•</span>
        <span>Up to {{ $roomType->capacity }} guests</span>
    </div>
    <h4 class="text-sm font-medium text-gray-700 mb-2">Amenities:</h4>
    <div class="flex flex-wrap gap-2">
        @foreach ($roomType->amenities as $amenity)
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                {{ $amenity->name }}
            </span>
        @endforeach
    </div>
</div>

<p class="text-gray-600 mb-4">{{ $roomType->description }}</p>

<a 
    href="{{ route('booking', [
        'room_type_id' => $roomType->id,
        'check_in' => $check_in,
        'check_out' => $check_out,
        'guests' => $guests,
    ]) }}" 
    class="block w-full text-center bg-indigo-600 text-white rounded-md py-2 px-4 hover:bg-indigo-700 transition duration-150 ease-in-out"
>
    Book Now
</a> 