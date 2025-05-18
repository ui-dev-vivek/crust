<?php

namespace App\Filament\MyForms;

use Filament\Forms;

class ProductGroupForm
{

    public static function getProductGroupForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Title of Product Group')
                ->helperText('This will be the title of your product group.')
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                    $set('slug', \Illuminate\Support\Str::slug($state));
                }),
            Forms\Components\TextInput::make('slug')
                ->disabled()

                ->dehydrated()
                ->required()
                ->maxLength(255),
        ];
    }
}
