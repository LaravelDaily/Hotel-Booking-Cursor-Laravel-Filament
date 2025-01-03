<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use App\Models\RoomType;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:6',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Find an available room
        $availableRoom = Room::where('room_type_id', $validated['room_type_id'])
            ->where('is_available', true)
            ->whereDoesntHave('bookings', function ($query) use ($validated) {
                $query->where(function ($q) use ($validated) {
                    $q->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                        ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                        ->orWhere(function ($q) use ($validated) {
                            $q->where('check_in', '<=', $validated['check_in'])
                                ->where('check_out', '>=', $validated['check_out']);
                        });
                });
            })
            ->first();

        if (!$availableRoom) {
            return back()->withErrors([
                'availability' => 'Sorry, no rooms of this type are available for the selected dates.'
            ])->withInput();
        }

        $roomType = RoomType::findOrFail($validated['room_type_id']);
        
        $pricing = $this->pricingService->calculateBookingPrice(
            $roomType,
            $validated['check_in'],
            $validated['check_out']
        );

        try {
            DB::beginTransaction();

            $customer = Customer::firstOrCreate(
                ['email' => $validated['email']],
                ['name' => $validated['name']]
            );

            $booking = Booking::create([
                'room_type_id' => $validated['room_type_id'],
                'room_id' => $availableRoom->id,
                'customer_id' => $customer->id,
                'guests' => $validated['guests'],
                'check_in' => $validated['check_in'],
                'check_out' => $validated['check_out'],
                'total_price' => $pricing['total_price'],
            ]);

            DB::commit();

            return redirect()->route('booking.confirmation', $booking);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'An error occurred while processing your booking. Please try again.'
            ])->withInput();
        }
    }

    public function confirmation(Booking $booking)
    {
        return view('bookings.confirmation', [
            'booking' => $booking
        ]);
    }
} 