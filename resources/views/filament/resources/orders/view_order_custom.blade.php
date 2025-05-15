<x-filament::page>
    <x-filament::section>
        <x-slot name="heading">
            Order Placed By
        </x-slot>

        <div class="grid grid-cols-1 gap-6 text-sm text-gray-800 md:grid-cols-2">
            {{-- User Info --}}
            <div>
                <h3 class="mb-2 text-base font-semibold text-gray-900">User Details</h3>
                <ul class="space-y-1">
                    <li><span class="font-medium">Name:</span> {{ $record->user->name ?? '-' }}</li>
                    <li><span class="font-medium">Email:</span> {{ $record->user->email ?? '-' }}</li>
                    <li><span class="font-medium">Phone:</span> {{ $record->user->phone ?? '-' }}</li>
                </ul>
            </div>

            {{-- Address Info --}}
            <div>
                <h3 class="mb-2 text-base font-semibold text-gray-900">Shipping Address</h3>
                <ul class="space-y-1">
                    <li><span class="font-medium">Address Line 1:</span><br> {{ $record->address->address_line1 ?? '-' }},
                        {{ $record->address->address_line2 ?? '-' }}
                    </li>
                    <li><span class="font-medium">City:</span> {{ $record->address->city ?? '-' }}</li>
                    <li><span class="font-medium">State:</span> {{ $record->address->state ?? '-' }}</li>
                    <li><span class="font-medium">Postal Code:</span> {{ $record->address->postal_code ?? '-' }}</li>
                    <li><span class="font-medium">Country:</span> {{ $record->address->country ?? '-' }}</li>
                </ul>
            </div>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">

        </x-slot>

        <x-filament::grid columns="2">
            <div>
                <p><strong>Order ID:</strong> #{{ $record->id }}</p>
                <p><strong>Status:</strong>
                    <x-filament::badge color="{{ [
                        'pending' => 'gray',
                        'confirmed' => 'info',
                        'shipped' => 'warning',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        'returned' => 'secondary',
                    ][$record->order_status] }}">
                        {{ ucfirst($record->order_status) }}
                    </x-filament::badge>
                </p>
                <p><strong>Payment:</strong> {{ strtoupper($record->payment_method) }}</p>
            </div>
            <div class="text-right">
                <p><strong>Shipping:</strong> ₹{{ number_format($record->shipping_charge, 2) }}</p>
                <p><strong>Discount:</strong> -₹{{ number_format($record->discount_amount, 2) }}</p>
                <p class="text-xl font-bold text-primary-600">
                    <strong>Grand Total:</strong> ₹{{ number_format($record->grand_total, 2) }}
                </p>
            </div>
        </x-filament::grid>
    </x-filament::section>

    {{-- Order Items --}}
    <x-filament::section>
        <x-slot name="heading">

        </x-slot>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="text-gray-700 bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Product</th>
                        <th class="px-4 py-2 text-left">Variant</th>
                        <th class="px-4 py-2 text-left">Quantity</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($record->items as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item->product->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->variant->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2">₹{{ number_format($item->price, 2) }}</td>
                        <td class="px-4 py-2">₹{{ number_format($item->total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::section>

    {{-- Status Update Form --}}
    <x-filament::section>
        <x-slot name="heading">
            Update Order Status
        </x-slot>

        <form wire:submit.prevent="updateStatus" class="mt-4 space-y-4">
            <div>
                <label for="order_status" class="block mb-1 text-sm font-medium text-gray-700">
                    Order Status
                </label>
                <select
                    id="order_status"
                    wire:model.defer="order_status"
                    class="block w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="returned">Returned</option>
                </select>
            </div>

            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white transition duration-150 rounded-md shadow-sm bg-primary-600 hover:bg-primary-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Update Status
            </button>
        </form>

    </x-filament::section>
</x-filament::page>
