<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);
beforeEach(function () {
    $this->seed(HotelSettingsSeeder::class);
});

test('homepage can be rendered', function () {
    get('/')
        ->assertOk()
        ->assertViewIs('welcome')
        ->assertSee('Find Your Perfect Room');
}); 