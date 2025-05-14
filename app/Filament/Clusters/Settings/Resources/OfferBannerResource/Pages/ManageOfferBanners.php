<?php

namespace App\Filament\Clusters\Settings\Resources\OfferBannerResource\Pages;

use App\Filament\Clusters\Settings\Resources\OfferBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOfferBanners extends ManageRecords
{
    protected static string $resource = OfferBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
