@extends('layouts.app')

@section('title', 'Welcome - Luxury Hotel')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-xl p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Find Your Perfect Room</h2>
        <form action="{{ route('rooms.search') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="check_in" class="block text-sm font-medium text-gray-700 mb-1">Check In</label>
                    <input 
                        type="date" 
                        name="check_in" 
                        id="check_in"
                        value="{{ now()->addDay()->format('Y-m-d') }}"
                        min="{{ now()->addDay()->format('Y-m-d') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>
                <div>
                    <label for="check_out" class="block text-sm font-medium text-gray-700 mb-1">Check Out</label>
                    <input 
                        type="date" 
                        name="check_out" 
                        id="check_out"
                        value="{{ now()->addDays(6)->format('Y-m-d') }}"
                        min="{{ now()->addDays(2)->format('Y-m-d') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>
                <div>
                    <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
                    <select 
                        name="guests" 
                        id="guests"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">{{ $i }} {{ Str::plural('Guest', $i) }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <button 
                type="submit"
                class="w-full bg-indigo-600 text-white rounded-md py-2 px-4 hover:bg-indigo-700 transition duration-150 ease-in-out"
            >
                Search Available Rooms
            </button>
        </form>
    </div>
</div>
@endsection
