<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderItemsWidget extends BaseWidget
{
    protected static string $view = 'filament.resources.order_resource.widgets.order_items_widget';

    public $record;

    public function mount($record)
    {
        $this->record = $record;
    }
}
