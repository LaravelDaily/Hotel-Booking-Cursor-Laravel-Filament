<?php

namespace Database\Seeders;

use App\Models\Amenity;
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
                'size' => 28,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning']
            ],
            [
                'name' => 'Deluxe Room',
                'description' => 'Spacious room with premium amenities',
                'price_per_night' => 200.00,
                'capacity' => 2,
                'size' => 35,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning', 'Mini Bar', 'Safe']
            ],
            [
                'name' => 'Family Suite',
                'description' => 'Large suite perfect for families',
                'price_per_night' => 350.00,
                'capacity' => 4,
                'size' => 65,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning', 'Mini Bar', 'Safe', 'Kitchen', 'Living Room']
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'Luxurious suite with all premium amenities',
                'price_per_night' => 800.00,
                'capacity' => 4,
                'size' => 120,
                'amenities' => ['Wi-Fi', 'TV', 'Air Conditioning', 'Mini Bar', 'Safe', 'Kitchen', 'Living Room', 'Jacuzzi', 'Ocean View', 'Balcony']
            ],
        ];

        foreach ($roomTypes as $roomTypeData) {
            $amenityNames = $roomTypeData['amenities'];
            unset($roomTypeData['amenities']);
            
            $roomType = RoomType::create($roomTypeData);
            
            $amenities = Amenity::whereIn('name', $amenityNames)->get();
            $roomType->amenities()->attach($amenities);
        }
    }
} 