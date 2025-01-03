<?php

namespace App\Services;

use App\Models\RoomType;
use Carbon\Carbon;

class PricingService
{
    public function calculateBookingPrice(RoomType $roomType, string $checkIn, string $checkOut): array
    {
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);
        
        $nights = $checkInDate->diffInDays($checkOutDate);
        $totalPrice = $roomType->price_per_night * $nights;
        
        return [
            'nights' => $nights,
            'price_per_night' => $roomType->price_per_night,
            'total_price' => $totalPrice,
        ];
    }
} 