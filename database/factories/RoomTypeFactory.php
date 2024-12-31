<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Standard', 'Deluxe', 'Suite', 'Presidential Suite']),
            'description' => fake()->paragraph(),
            'price_per_night' => fake()->numberBetween(100, 1000),
            'capacity' => fake()->numberBetween(1, 6),
            'amenities' => fake()->randomElements([
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
            ], fake()->numberBetween(3, 8))
        ];
    }
} 