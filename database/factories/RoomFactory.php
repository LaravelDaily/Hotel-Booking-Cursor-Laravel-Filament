<?php

namespace Database\Factories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_number' => '101',
            'floor' => 1,
            'room_type_id' => RoomType::factory(),
            'is_available' => fake()->boolean(90),
            'notes' => fake()->optional(0.3)->sentence()
        ];
    }
} 