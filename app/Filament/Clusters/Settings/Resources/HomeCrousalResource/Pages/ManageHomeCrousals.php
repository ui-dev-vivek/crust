<?php

namespace App\Filament\Clusters\Settings\Resources\HomeCrousalResource\Pages;

use App\Filament\Clusters\Settings\Resources\HomeCrousalResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHomeCrousals extends ManageRecords
{
    protected static string $resource = HomeCrousalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
