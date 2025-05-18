<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create New Product')
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->iconPosition('after')
                ->button()
                ->size('lg')
                ->modalHeading('Create New Product'),

        ];
    }
}
