<?php

namespace Database\Factories;

use App\Models\Amenity;
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
            'size' => fake()->numberBetween(25, 120),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($roomType) {
            $amenities = Amenity::inRandomOrder()
                ->take(fake()->numberBetween(3, 8))
                ->get();
            
            $roomType->amenities()->attach($amenities);
        });
    }
} 