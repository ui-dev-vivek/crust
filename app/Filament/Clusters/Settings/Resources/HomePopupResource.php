<?php

namespace App\Filament\Clusters\Settings\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Clusters\Settings\Resources\HomePopupResource\Pages;
use App\Filament\Clusters\Settings\Resources\HomePopupResource\RelationManagers;
use App\Models\HomePopup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomePopupResource extends Resource
{
    protected static ?string $model = HomePopup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Settings::class;

    public static function form(Form $form): Form
    {

        return $form

            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Textarea::make('short_description')
                    ->columnSpanFull()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('btn_lable')
                ->label('Button Label')
                ->helperText('Label for the button that will be shown on the popup to redirect the user to the URL')
                    ->maxLength(15),
                Forms\Components\TextInput::make('btn_url')
                    ->label('Button URL')
                    ->helperText('URL that will be opened when the button is clicked')
                    ->url()
                    ->maxLength(255),
            ])->columns(2)
            ->columns([
                'sm' => 2,
                'lg' => 2,
                'xl' => 2,
            ]);



    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Split::make([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->color('primary')
                    ->sortable(),

                Stack::make([
                    TextColumn::make('btn_lable')
                        ->label('Button Label')
                        ->searchable()
                        ->sortable(),

                    TextColumn::make('btn_url')
                        ->label('Button URL')
                        ->searchable()
                        ->sortable(),
                ])->columnSpan([
                    'sm' => 2,
                    'lg' => 2,
                    'xl' => 2,
                ]),
            ])->columnSpan([
                'sm' => 2,
                'lg' => 2,
                'xl' => 2,
            ]),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHomePopups::route('/'),
        ];
    }
}
