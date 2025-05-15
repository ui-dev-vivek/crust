<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\Widget;

class OrderPaymentWidget extends Widget
{
    protected static string $view = 'filament.resources.order_resource.widgets.order_payment_widget';
    public $record;

    public function mount($record)
    {
        $this->record = $record;
    }
}
