<?php

namespace App\Filament\Clusters\Settings\Resources\ProductGroupResource\Pages;

use App\Filament\Clusters\Settings\Resources\ProductGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProductGroups extends ManageRecords
{
    protected static string $resource = ProductGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
