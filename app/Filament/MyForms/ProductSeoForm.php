<?php

namespace App\Filament\MyForms;

use App\Models\Product;
use Filament\Forms;

class ProductSeoForm
{
    public static function getProductSeoForm(): array
    {
        return [
            Forms\Components\TextInput::make('meta_title')
                ->label('Meta Title')
                ->maxLength(255)
                ->required(),

            Forms\Components\Textarea::make('meta_description')
                ->label('Meta Description')
                ->rows(4)
                ->maxLength(200) // optionally limit, since it's TEXT
                ->required(),

            Forms\Components\Textarea::make('meta_keywords')
                ->label('Meta Keywords')
                ->rows(3)
                ->maxLength(210) // optionally limit
                ->hint('Separate keywords with commas')
                ->required(),

        ];
    }
}
