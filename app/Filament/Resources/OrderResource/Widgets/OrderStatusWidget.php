<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\Widget;
use Filament\Forms\Components\Select;

class OrderStatusWidget extends Widget
{
    protected static string $view = 'filament.resources.order_resource.widgets.order_status_widget';
    public $record;
    public $order_status;

    public function mount($record)
    {
        $this->record = $record;
        $this->order_status = $record->order_status;
    }

    public function updateStatus()
    {
        dd();
        // dd($this->order_status);
        $this->record->update(['order_status' => $this->order_status]);
        $this->dispatch('notify', message: 'Order status updated.');
    }
}
