<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $roomTypes = RoomType::all();

        for ($i = 0; $i < 30; $i++) {
            $checkIn = Carbon::now()->addDays(fake()->numberBetween(1, 60));
            $checkOut = $checkIn->copy()->addDays(fake()->numberBetween(1, 7));
            $roomType = $roomTypes->random();
            $nights = $checkIn->diffInDays($checkOut);
            
            Booking::create([
                'room_type_id' => $roomType->id,
                'room_id' => null,
                'customer_id' => $customers->random()->id,
                'guests' => fake()->numberBetween(1, 4),
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $roomType->price_per_night * $nights,
            ]);
        }
    }
} 