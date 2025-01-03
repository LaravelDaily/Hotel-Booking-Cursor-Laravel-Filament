<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchRoomsController;
use Illuminate\Http\Request;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms/search', SearchRoomsController::class)->name('rooms.search');

Route::get('/booking', [BookingController::class, 'create'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])
    ->name('booking.confirmation');
