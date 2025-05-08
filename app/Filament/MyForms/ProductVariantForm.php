<?php

namespace App\Filament\MyForms;

use Filament\Forms;
use Filament\Forms\Form;

class ProductVariantForm
{

    public static function getProductVariantForm(): array
    {

        //     'product_id', 'sku', 'price', 'quantity', 'is_base', 'status'

        // 'product_variant_id',
        // 'key',
        // 'value'

        return [
            Forms\Components\Grid::make(2) // 2 columns layout
                ->schema([
                    Forms\Components\TextInput::make('sku')
                        ->label('SKU')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->required()
                        ->prefix('₹')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('quantity')
                        ->label('Stock Quantity')
                        ->numeric()
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Toggle::make('is_base')
                        ->label('Is Base Variant')
                        ->inline(false),

                    Forms\Components\Toggle::make('status')
                        ->label('Active Status')
                        ->inline(false),
                    Forms\Components\KeyValue::make('attributes')
                        ->label('Variant Attributes') // JSON: {"Size": "M", "Color": "Red"}
                        ->keyLabel('Attribute')
                        ->valueLabel('Value')
                        // ->addButtonLabel('Add Attribute')
                        ->required(),
                ]),

        ];
    }
}
