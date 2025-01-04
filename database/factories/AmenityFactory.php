<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AmenityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
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
            ]),
        ];
    }
} 