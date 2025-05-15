<x-filament::section>
    <x-slot name="header">Order Items</x-slot>
    <table class="w-full text-sm">
        <thead>
            <tr>
                <th>Product</th>
                <th>Variant</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($record->items as $item)
            <tr>
                <td>{{ $item->product->name ?? '-' }}</td>
                <td>{{ $item->variant->name ?? '-' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ $item->price }}</td>
                <td>₹{{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::section>
