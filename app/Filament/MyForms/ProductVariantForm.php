<?php

namespace App\Filament\MyForms;


use App\Models\ProductVariant;
use Filament\Forms;
use Filament\Forms\Form;

class ProductVariantForm
{
    public static function getProductVariantForm(): array
    {
        return [
            Forms\Components\Grid::make(2) // Main 2-column grid
                ->schema([
                     // RIGHT COLUMN: Price & Stock Info
                     Forms\Components\Grid::make()
                     ->schema([
                         Forms\Components\TextInput::make('sku')
                             ->label('SKU')
                             ->required()
                             ->unique(ProductVariant::class, 'sku', ignoreRecord: true)
                             ->columnSpanFull()
                             ->maxLength(255),

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
                     ])
                     ->columnSpan(1),
                    Forms\Components\Repeater::make('attributes')
                        ->label('Variant Attributes')
                        ->schema([
                            Forms\Components\TextInput::make('key')
                                ->label('Attribute Key')
                                ->required(),
                            Forms\Components\TextInput::make('value')
                                ->label('Attribute Value')
                                ->required(),
                        ])
                        ->columns(2)
                        ->minItems(1)
                        ->addActionLabel('Add Attribute')
                        ->reorderable()
                        ->collapsible()
                        ->columnSpan(1)

                        ]),
                        Forms\Components\Repeater::make('images')
                        ->label('Variant Images')
                        ->schema([
                            Forms\Components\FileUpload::make('image_url')
                                ->label('Image')
                                ->image()
                                ->required()
                        ])
                        ->minItems(1)
                        ->addActionLabel('Add Image')
                        ->reorderable()
                        ->collapsible()
                        ->columnSpanFull(),


        ];
    }
}
