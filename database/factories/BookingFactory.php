<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $checkIn = Carbon::now()->addDays(fake()->numberBetween(1, 60));
        $checkOut = $checkIn->copy()->addDays(fake()->numberBetween(1, 7));
        $roomType = RoomType::factory()->create();
        
        return [
            'room_type_id' => $roomType->id,
            'room_id' => null,
            'customer_id' => Customer::factory(),
            'guests' => fake()->numberBetween(1, 4),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_price' => fake()->numberBetween(100, 1000),
        ];
    }
} 