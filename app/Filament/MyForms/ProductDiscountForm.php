<?php

namespace App\Filament\MyForms;
use App\Models\ProductDiscount;
use Filament\Forms;

class ProductDiscountForm
{
    public static function getProductDiscountForm(): array
    {
        return [
            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\Select::make('discount_type')
                        ->label('Discount Type')
                        ->options([
                            'flat' => 'Flat Discount',
                            'percent' => 'Percentage Discount',
                        ])
                        ->columnSpanFull()
                        ->required(),
                    Forms\Components\TextInput::make('amount')
                        ->label('Amount or Percentage')
                        ->helperText('Enter the amount or percentage of discount')
                        ->numeric()
                        ->live()
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('title')
                        ->label('Title')
                        ->helperText('This will be the title of your discount.')
                        ->placeholder('Flat 10% off on all products')
                        ->required()
                        ->columnSpanFull()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('starts_at')
                        ->label('Starts At')
                        ->columnSpanFull()
                        ->required(),
                    Forms\Components\DatePicker::make('ends_at')
                        ->label('Ends At')
                        ->columnSpanFull()
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                    ->columnSpanFull()
                        ->label('Is Active'),
                        ]),

            ];
    }
}
