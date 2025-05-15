<x-filament::section>
    <x-slot name="header">Payment Details</x-slot>

    <p><strong>Method:</strong> {{ strtoupper($record->payment_method) }}</p>
    <p><strong>Total Amount:</strong> ₹{{ $record->total_amount }}</p>
    <p><strong>Shipping:</strong> ₹{{ $record->shipping_charge }}</p>
    <p><strong>Discount:</strong> ₹{{ $record->discount_amount }}</p>
    <p><strong>Grand Total:</strong> ₹{{ $record->grand_total }}</p>
</x-filament::section>
