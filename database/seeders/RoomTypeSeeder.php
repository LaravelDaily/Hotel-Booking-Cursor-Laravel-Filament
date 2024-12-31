<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $roomTypes = [
            [
                'name' => 'Standard Room',
                'description' => 'Comfortable room with basic amenities',
                'price_per_night' => 100.00,
                'capacity' => 2,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning']
            ],
            [
                'name' => 'Deluxe Room',
                'description' => 'Spacious room with premium amenities',
                'price_per_night' => 200.00,
                'capacity' => 2,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning', 'Mini Bar', 'Safe']
            ],
            [
                'name' => 'Family Suite',
                'description' => 'Large suite perfect for families',
                'price_per_night' => 350.00,
                'capacity' => 4,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning', 'Mini Bar', 'Safe', 'Kitchen', 'Living Room']
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'Luxurious suite with all premium amenities',
                'price_per_night' => 800.00,
                'capacity' => 4,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning', 'Mini Bar', 'Safe', 'Kitchen', 'Living Room', 'Jacuzzi', 'Ocean View', 'Balcony']
            ],
        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
} 