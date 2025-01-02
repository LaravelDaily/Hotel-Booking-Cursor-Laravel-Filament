<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class SearchRoomsController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:6',
        ]);

        $roomTypes = RoomType::with('amenities')
            ->where('capacity', '>=', $request->guests)
            ->orderBy('price_per_night')
            ->get();

        return view('rooms.search-results', [
            'roomTypes' => $roomTypes,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
        ]);
    }
} 