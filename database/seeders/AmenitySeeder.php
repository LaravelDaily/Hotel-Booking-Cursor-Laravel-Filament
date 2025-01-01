<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            'Wi-Fi',
            'TV',
            'Mini Bar',
            'Air Conditioning',
            'Safe',
            'Balcony',
            'Ocean View',
            'Kitchen',
            'Living Room',
            'Jacuzzi'
        ];

        foreach ($amenities as $amenity) {
            Amenity::create(['name' => $amenity]);
        }
    }
} 