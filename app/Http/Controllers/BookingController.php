<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Services\PricingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(
        private PricingService $pricingService
    ) {}

    public function create(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:6',
        ]);

        $roomType = RoomType::findOrFail($request->room_type_id);
        
        $pricing = $this->pricingService->calculateBookingPrice(
            $roomType,
            $request->check_in,
            $request->check_out
        );

        return view('bookings.create', [
            'roomType' => $roomType,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'pricing' => $pricing,
        ]);
    }

    public function store(Request $request)
    {
        // TODO: Implement booking storage
        return redirect()->back();
    }
} 