<?php

namespace App\Filament\Clusters\Settings\Resources\CategoryResource\Pages;

use App\Filament\Clusters\Settings\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;
    protected static ?string $title = 'List of Categories';
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Category')->icon('heroicon-o-plus')
                ->color('primary')
                ->tooltip('Create Category you may create at adding products also'),
        ];
    }

}
