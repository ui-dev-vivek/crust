<?php

namespace App\Filament\MyForms;

use Filament\Forms;

class ProductTypeForm
{

    public static function getProductTypeForm(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('code')
                ->dehydrated()
                ->required()
                ->maxLength(10),
        ];
    }
}
