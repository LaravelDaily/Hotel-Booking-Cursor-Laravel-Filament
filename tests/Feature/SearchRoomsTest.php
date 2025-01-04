<?php

use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(HotelSettingsSeeder::class);
    $this->amenity = Amenity::factory()->create(['name' => 'Wi-Fi']);
    $this->roomType = RoomType::factory()->create([
        'capacity' => 2,
        'price_per_night' => 100,
    ]);
    $this->roomType->amenities()->attach($this->amenity);
    
    $this->room = Room::factory()->create([
        'room_type_id' => $this->roomType->id,
        'is_available' => true,
    ]);
});

test('search page requires all parameters', function () {
    $response = $this->get('/rooms/search');
    $response->assertSessionHasErrors(['check_in', 'check_out', 'guests']);
});

test('search page validates dates', function () {
    $response = $this->get('/rooms/search', [
        'check_in' => 'invalid-date',
        'check_out' => 'invalid-date',
        'guests' => 2,
    ]);
    
    $response->assertSessionHasErrors(['check_in', 'check_out']);
});

test('search page validates future dates', function () {
    $response = $this->get('/rooms/search', [
        'check_in' => now()->subDay()->format('Y-m-d'),
        'check_out' => now()->format('Y-m-d'),
        'guests' => 2,
    ]);
    
    $response->assertSessionHasErrors(['check_in']);
});

test('search page validates check_out after check_in', function () {
    $response = $this->get('/rooms/search', [
        'check_in' => now()->addDays(2)->format('Y-m-d'),
        'check_out' => now()->addDay()->format('Y-m-d'),
        'guests' => 2,
    ]);
    
    $response->assertSessionHasErrors(['check_out']);
});

test('search page validates guest count', function () {
    $response = $this->get('/rooms/search', [
        'check_in' => now()->addDay()->format('Y-m-d'),
        'check_out' => now()->addDays(2)->format('Y-m-d'),
        'guests' => 0,
    ]);
    
    $response->assertSessionHasErrors(['guests']);

    $response = $this->get('/rooms/search', [
        'check_in' => now()->addDay()->format('Y-m-d'),
        'check_out' => now()->addDays(2)->format('Y-m-d'),
        'guests' => 7,
    ]);
    
    $response->assertSessionHasErrors(['guests']);
});

test('search shows available rooms', function () {
    $response = $this->get('/rooms/search?' . http_build_query([
        'check_in' => now()->addDay()->format('Y-m-d'),
        'check_out' => now()->addDays(2)->format('Y-m-d'),
        'guests' => 2,
    ]));
    
    $response->assertOk()
        ->assertViewIs('rooms.search-results')
        ->assertSee($this->roomType->name)
        ->assertSee('$100.00/night');
});

test('search filters by guest capacity', function () {
    $response = $this->get('/rooms/search?' . http_build_query([
        'check_in' => now()->addDay()->format('Y-m-d'),
        'check_out' => now()->addDays(2)->format('Y-m-d'),
        'guests' => 3,
    ]));
    
    $response->assertOk()
        ->assertViewIs('rooms.search-results')
        ->assertDontSee($this->roomType->name);
}); 