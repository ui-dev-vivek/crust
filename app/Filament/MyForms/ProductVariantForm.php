<?php

namespace App\Filament\MyForms;

use App\Models\ProductVariant;
use Filament\Forms;

class ProductVariantForm
{
    public static function getProductVariantForm(): array
    {
        return [
            Forms\Components\Grid::make(2)
                ->schema([
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
                                ->prefix('₹'),

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
                        ->relationship('attributes')
                        ->schema([
                            Forms\Components\Select::make('key')
                                ->label('Variant Type')
                                ->options([
                                    'size' => 'Size',
                                    'color' => 'Color',
                                    'material' => 'Material',
                                    'pack' => 'Pack',
                                    'weight' => 'Weight',
                                    'volume' => 'Volume',
                                ])

                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    if ($state === 'color') {
                                        $set('value', '');
                                    }
                                }),
                            Forms\Components\TextInput::make('value')
                                ->label('Variant Value')
                                ->required()
                                ->hidden(fn ($get) => $get('key') === 'color'),
                            Forms\Components\ColorPicker::make('value')
                                ->label('Attribute Value')
                                ->required()
                                ->hidden(fn ($get) => $get('key') !== 'color'),
                        ])
                        ->columns(2)
                        // ->minItems(1)
                        ->addActionLabel('Add Attribute')
                        // ->reorderable()
                        ->collapsible()
                        ->columnSpan(1),

                ]),
            Forms\Components\Repeater::make('images')
                ->label('Variant Images')
                ->relationship('images')
                ->grid(2)
                ->schema([
                    Forms\Components\FileUpload::make('image_url')
                        ->image()
                        ->imageEditor()
                        ->imageEditorMode(2)
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('4:5')
                        ->directory('products')
                        ->visibility('private')
                        ->previewable(true),

                ])
                // ->minItems(1)
                ->defaultItems(2)
                ->addActionLabel('Add Image')
                ->reorderable()
                ->collapsible()
                ->columnSpanFull(),
        ];
    }
}
