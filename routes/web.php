<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchRoomsController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms/search', SearchRoomsController::class)->name('rooms.search');

Route::get('/booking', function (Request $request) {
    // TODO: Implement booking logic
    return redirect()->back();
})->name('booking');
