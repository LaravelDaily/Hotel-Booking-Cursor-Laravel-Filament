<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AmenitySeeder::class,
            RoomTypeSeeder::class,
            RoomSeeder::class,
            UserSeeder::class,
        ]);
    }
}
