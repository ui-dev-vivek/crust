<?php

namespace App\Filament\Clusters\Settings\Resources\ProductTypeResource\Pages;

use App\Filament\Clusters\Settings\Resources\ProductTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProductTypes extends ManageRecords
{
    protected static string $resource = ProductTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
