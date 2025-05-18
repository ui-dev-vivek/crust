<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;
    public function getTitle(): string
    {
        return 'Product Details';
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Edit Product')
                ->icon('heroicon-o-pencil-square')

                ->color('secondary')
                // ->iconPosition('after')
                ->button()
                ->size('sm')
                ->modalHeading('Edit Product'),
        ];
    }
}
