<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;
    protected static string $view = 'filament.resources.orders.view_order_custom';
    public $order_status;

    public function mount(int|string $record): void
    {

        parent::mount($record);
        $this->order_status = $this->record->order_status;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('Print Invoice')
                ->icon('heroicon-o-printer')
                // ->url(fn(Order $record) => route('orders.invoice', $record))
                ->openUrlInNewTab(),

        ];
    }


    public function updateStatus()
    {
        $this->record->update(['order_status' => $this->order_status]);
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Order status updated successfully.',
        ]);
    }
}
