<div class="mb-8 p-4 bg-gray-50 rounded-lg">
    <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $roomType->name }}</h3>
    <div class="text-gray-600 space-y-1">
        <p>{{ $pricing['nights'] }} {{ Str::plural('night', $pricing['nights']) }}</p>
        <p>{{ $guests }} {{ Str::plural('guest', $guests) }}</p>
        <p>Check-in: {{ Carbon\Carbon::parse($check_in)->format('M d, Y') }}</p>
        <p>Check-out: {{ Carbon\Carbon::parse($check_out)->format('M d, Y') }}</p>
    </div>
</div> 