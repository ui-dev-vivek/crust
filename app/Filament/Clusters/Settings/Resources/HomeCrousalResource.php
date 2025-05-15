<?php

namespace App\Filament\Clusters\Settings\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Clusters\Settings\Resources\HomeCrousalResource\Pages;
use App\Filament\Clusters\Settings\Resources\HomeCrousalResource\RelationManagers;
use App\Models\HomeCrousal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeCrousalResource extends Resource
{
    protected static ?string $model = HomeCrousal::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $label = 'Home Crousal';
    protected static ?string $navigationLabel = 'Crousals at Top of Home';
    protected static ?string $navigationGroup = 'Design';
    protected static ?int $navigationSort = 0;

    protected static ?string $cluster = Settings::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Heading Text')
                    ->helperText('This will be shown at the top of the Banner.')
                    ->required()->columnSpanFull()
                    ->maxLength(255),

                Forms\Components\TextInput::make('btn_lable')
                    ->maxLength(255)
                    ->label('Button Text')
                    ->helperText('This will be shown on the Button.')
                    ->default(null),
                Forms\Components\TextInput::make('btn_url')
                    ->maxLength(255)
                    ->label('Button URL')
                    ->helperText('This will be the URL of the Button.')
                    ->default(null),

                    Forms\Components\Toggle::make('status')
                    ->helperText('Active or Inactive.')
                    ->label('Active')
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true)
                    ->required(),
                    Forms\Components\FileUpload::make('image')
                    ->label('Banner Background Image')
                    ->directory('home-crousal')
                    ->image()
                    ->required()
                    ->imageEditor()
                    ->imageEditorMode(2)
                    ->imageResizeMode('cover')
                    ->columnSpanFull()
                    ->imageCropAspectRatio('1920:600'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('btn_lable')
                    ->searchable(),
                Tables\Columns\TextColumn::make('btn_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageHomeCrousals::route('/'),
        ];
    }
}
