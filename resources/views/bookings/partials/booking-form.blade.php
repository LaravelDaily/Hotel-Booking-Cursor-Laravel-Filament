<form action="{{ route('booking.store') }}" method="POST" class="space-y-6">
    @csrf
    
    <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
    <input type="hidden" name="check_in" value="{{ $check_in }}">
    <input type="hidden" name="check_out" value="{{ $check_out }}">
    <input type="hidden" name="guests" value="{{ $guests }}">

    <div class="grid grid-cols-1 gap-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input 
                type="text" 
                name="name" 
                id="name"
                required
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input 
                type="email" 
                name="email" 
                id="email"
                required
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
        </div>
    </div>

    <button 
        type="submit"
        class="w-full bg-indigo-600 text-white rounded-md py-2 px-4 hover:bg-indigo-700 transition duration-150 ease-in-out"
    >
        Complete Booking
    </button>
</form> 