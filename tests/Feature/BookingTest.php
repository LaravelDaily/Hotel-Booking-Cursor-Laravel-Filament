<?php

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(HotelSettingsSeeder::class);
    $this->roomType = RoomType::factory()->create([
        'price_per_night' => 100,
    ]);
    
    $this->room = Room::factory()->create([
        'room_type_id' => $this->roomType->id,
        'is_available' => true,
    ]);

    $this->validParams = [
        'room_type_id' => $this->roomType->id,
        'check_in' => now()->addDay()->format('Y-m-d'),
        'check_out' => now()->addDays(2)->format('Y-m-d'),
        'guests' => 2,
    ];
});

test('booking page requires valid parameters', function () {
    $response = $this->get('/booking');
    $response->assertSessionHasErrors(['room_type_id', 'check_in', 'check_out', 'guests']);
});

test('booking page shows room details', function () {
    $response = $this->get('/booking?' . http_build_query($this->validParams));
    
    $response->assertOk()
        ->assertViewIs('bookings.create')
        ->assertSee($this->roomType->name)
        ->assertSee('$100.00');
});

test('booking creation requires all fields', function () {
    $response = $this->post('/booking', $this->validParams);
    
    $response->assertSessionHasErrors(['name', 'email']);
});

test('booking can be created', function () {
    $response = $this->post('/booking', [
        ...$this->validParams,
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
    
    $booking = Booking::first();
    
    $this->assertNotNull($booking);
    $response->assertRedirect(route('booking.confirmation', $booking));
    
    $this->assertDatabaseHas('customers', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
    
    $this->assertDatabaseHas('bookings', [
        'room_type_id' => $this->roomType->id,
        'room_id' => $this->room->id,
        'guests' => 2,
        'total_price' => 100, // One night at $100
    ]);
});

test('booking fails if room not available', function () {
    // Create an existing booking for the same dates
    $customer = Customer::factory()->create();
    Booking::create([
        'room_type_id' => $this->roomType->id,
        'room_id' => $this->room->id,
        'customer_id' => $customer->id,
        'check_in' => now()->addDay()->format('Y-m-d'),
        'check_out' => now()->addDays(2)->format('Y-m-d'),
        'guests' => 2,
        'total_price' => 100,
    ]);

    $response = $this->post('/booking', [
        ...$this->validParams,
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
    
    $response->assertSessionHasErrors(['availability']);
    
    $this->assertDatabaseMissing('bookings', [
        'customer_id' => Customer::where('email', 'john@example.com')->first()?->id,
    ]);
});

test('booking confirmation page can be viewed', function () {
    $customer = Customer::factory()->create();
    $booking = Booking::create([
        'room_type_id' => $this->roomType->id,
        'room_id' => $this->room->id,
        'customer_id' => $customer->id,
        'check_in' => now()->addDay()->format('Y-m-d'),
        'check_out' => now()->addDays(2)->format('Y-m-d'),
        'guests' => 2,
        'total_price' => 100,
    ]);

    $response = $this->get(route('booking.confirmation', $booking));
    
    $response->assertOk()
        ->assertViewIs('bookings.confirmation')
        ->assertSee('Booking Successful');
}); 