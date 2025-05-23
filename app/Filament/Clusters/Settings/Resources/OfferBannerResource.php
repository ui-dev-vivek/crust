<?php

namespace App\Filament\Clusters\Settings\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Clusters\Settings\Resources\OfferBannerResource\Pages;
use App\Filament\Clusters\Settings\Resources\OfferBannerResource\RelationManagers;
use App\Models\OfferBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;

class OfferBannerResource extends Resource
{
    protected static ?string $model = OfferBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Banners';
    protected static ?string $navigationGroup = 'Design';
    protected static ?int $navigationSort = 0;

    protected static ?string $cluster = Settings::class;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Grid::make([
                'default' => 12,
                'md' => 12,
            ])
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('title')
                    ->placeholder('20% OFF on Red Rose candles')
                    ->helperText('Title of the offer to be shown on the offer banner.')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('link_url')
                    ->label('Banner URL')
                    ->placeholder('www.mavafashion.com')
                    ->helperText('URL to which the offer banner will redirect the user.')
                    ->maxLength(255)
                    ->url()
                    ->required()
                    ->default(null),
                    Forms\Components\TextInput::make('placement')
                    ->placeholder('Homepage')
                    ->helperText('Placement of the offer banner. where it will be shown.')
                    ->label('Placement')
                    ->required()
                    ->maxLength(255),

                ])->columnSpan(8),
                Forms\Components\Group::make([

                    Forms\Components\Toggle::make('status')
                    ->helperText('Active or Inactive.')
                    ->label('Active')
                    ->onIcon('heroicon-m-check-circle')
                    ->offIcon('heroicon-m-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(true)
                    ->required()
                    ->columnSpanFull()
                    ->default(true),
                    Forms\Components\Select::make('category')
                    ->relationship('category', 'name')
                    ->helperText('Category to which the offer banner belongs.')
                    ->label('Category')

                    ->default(null),
                    Forms\Components\Select::make('group')
                    ->label('Product Group')
                    ->relationship('group', 'name')
                    ->helperText('Product group to which the offer banner belongs.')

                    ->default(null),

                ])->columnSpan(4),
                Forms\Components\FileUpload::make('image_url')
                ->image()
                ->label('Image')
                ->imageEditor()
                ->directory('offer-banners')
                ->preserveFilenames()
                ->visibility('public')
                ->helperText('Image for the offer banner.')
                ->required()
                ->columnSpanFull(),

                ]), ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Split::make([
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->width(280)
                    ->height(280)

                    ->default('https://via.placeholder.com/150'),
                    // ->circular(), // optional for rounded image

                Stack::make([
                    TextColumn::make('title')
                        ->label('Title')
                        ->weight('bold')
                        ->size('lg')
                        ->searchable(),

                    TextColumn::make('link_url')
                        ->label('Link')
                        ->searchable()
                        ->color('primary')
                        ->url(fn ($record) => $record->link_url, true),

                    TextColumn::make('placement')
                        ->label('Placement')
                        ->searchable(),

                    TextColumn::make('category.name')

                        ->label('Category')
                        ->badge()
                        ->color('info'),

                    TextColumn::make('group.name')
                        ->label('Product Group')
                        ->badge()
                        ->color('gray'),

                    TextColumn::make('status')
                        ->label('Status')
                        ->badge()

                        ->color(fn ($state) => match ($state) {
                            1 => 'success',
                            0 => 'danger',
                            default => 'gray',
                        }),
                ]),
            ]),
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
            'index' => Pages\ManageOfferBanners::route('/'),
        ];
    }
}
