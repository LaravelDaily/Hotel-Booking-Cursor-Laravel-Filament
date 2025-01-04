<?php

namespace Database\Seeders;

use App\Models\HotelSettings;
use Illuminate\Database\Seeder;

class HotelSettingsSeeder extends Seeder
{
    public function run(): void
    {
        HotelSettings::create([
            'hotel_name' => 'Luxury Hotel',
            'email' => 'info@luxuryhotel.com',
            'phone' => '+1 (555) 123-4567',
            'address' => '123 Luxury Street, Beverly Hills, CA 90210',
            'facebook_url' => 'https://facebook.com/luxuryhotel',
            'instagram_url' => 'https://instagram.com/luxuryhotel',
            'twitter_url' => 'https://twitter.com/luxuryhotel',
        ]);
    }
} 