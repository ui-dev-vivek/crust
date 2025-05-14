<?php

namespace App\Filament\Clusters\Settings\Resources\HomeCrousalResource\Pages;

use App\Filament\Clusters\Settings\Resources\HomeCrousalResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHomeCrousals extends ManageRecords
{

    protected static string $resource = HomeCrousalResource::class;
    protected static ?string $title = 'List of Crousals';




    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Crousal')->icon('heroicon-o-plus')
                ->color('primary'),
        ];
    }
}
