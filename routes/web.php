<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms/search', function () {
    // TODO: Implement room search logic
    return redirect()->back();
})->name('rooms.search');
