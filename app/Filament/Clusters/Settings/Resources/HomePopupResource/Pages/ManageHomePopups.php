<?php

namespace App\Filament\Clusters\Settings\Resources\HomePopupResource\Pages;

use App\Filament\Clusters\Settings\Resources\HomePopupResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHomePopups extends ManageRecords
{
    protected static string $resource = HomePopupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
