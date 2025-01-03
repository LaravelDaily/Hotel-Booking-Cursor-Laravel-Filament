<div class="mb-8 p-4 bg-indigo-50 rounded-lg">
    <div class="space-y-2">
        <div class="flex justify-between text-gray-600">
            <span>${{ number_format($pricing['price_per_night'], 2) }} × {{ $pricing['nights'] }} nights</span>
            <span>${{ number_format($pricing['total_price'], 2) }}</span>
        </div>
        <div class="flex justify-between font-semibold text-lg border-t border-indigo-100 pt-2">
            <span>Total (USD)</span>
            <span>${{ number_format($pricing['total_price'], 2) }}</span>
        </div>
        <p class="text-sm text-gray-500 mt-2">Payment will be collected upon arrival</p>
    </div>
</div> 