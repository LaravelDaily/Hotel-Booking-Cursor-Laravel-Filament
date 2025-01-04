@php
    $settings = \App\Models\HotelSettings::first();
@endphp

<!-- Navigation -->
<nav class="relative z-10 px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-white text-2xl font-semibold">{{ $settings->hotel_name }}</a>
    </div>
</nav> 