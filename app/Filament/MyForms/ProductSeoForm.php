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
                ->helperText('This will be the title of your product in search engines.')
                ->placeholder('Soft rose Pillar Candle | Soft Rose | Pack of 2')
                ->maxLength(255)
                ->required(),

            Forms\Components\Textarea::make('meta_description')
                ->label('Meta Description')
                ->rows(4)
                ->helperText('This will be the description of your product in search engines.')
                ->placeholder('Soft rose Pillar Candle | Soft Rose | Pack of 2')
                ->maxLength(200) // optionally limit, since it's TEXT
                ->required(),

                Forms\Components\Textarea::make('meta_keywords')
                ->label('Meta Keywords')

                ->helperText('This will be the keywords of your product in search engines.')
                // ->placeholder('')

                ->hint('Separate keywords with commas')
                ->required(),

        ];
    }
}
