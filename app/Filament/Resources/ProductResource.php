<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\MyForms\ProductForm;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    // protected static ?string $cluster = Settings::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $cluster = Products::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Products';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form->schema(
            ProductForm::getProductCreateForm()
        );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(fn ($record) => static::getUrl('view', ['record' => $record]))
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()
                    ->label('Product Name')
                    ->limit(30)
                    ->tooltip(fn (Product $record): string => $record->name),
                // Tables\Columns\TextColumn::make('slug')->wrap(),
                Tables\Columns\ImageColumn::make('primaryImage.image_url')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('total_stock')
                    ->label('Total Stock')
                    ->getStateUsing(fn (Product $record) => $record->variants->sum('quantity'))
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger')
                    ->tooltip(function (Product $record) {
                        return $record->variants
                            ->map(fn ($variant) => ($variant->sku ?? '').': '.$variant->quantity)
                            ->implode('] ['); // new line between each variant
                    }),

                Tables\Columns\TextColumn::make('category.name')->label('Category')->sortable(),
                Tables\Columns\TextColumn::make('type.name')->label('Type')->sortable(),
                Tables\Columns\TextColumn::make('group.name')->label('Group')->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y')->searchable()
                    ->label('Uploaded On')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('Group')
                    ->relationship('group', 'name')
                    ->searchable(),

                Tables\Filters\TernaryFilter::make('status')->label('Active'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                Grid::make(12)->schema([
                    Section::make('Product Images')
                    ->schema([
                        RepeatableEntry::make('images')
                            ->label('Images')
                            ->grid(2)


                            ->schema([

                                    ImageEntry::make('image_url')
                                        ->label('Image')

->width('100%')
->height('100%')                                        ->columnSpan(12),

                                    // TextEntry::make('is_primary')
                                    //     ->label('Primary')
                                    //     ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                                    //     ->columnSpan(2),

                            ])
                            ->columns(1), // each repeatable row
                    ])
                    ->columnSpan(8),
                    Section::make([
                        Grid::make(12)->schema([
                            TextEntry::make('status')
                                ->label('Active')
                                ->formatStateUsing(fn ($state) => $state ? 'Published' : 'Unpublished')
                                ->icon(fn (string $state): string => match ($state) {
                                    '1' => 'heroicon-o-check-circle',
                                    '0' => 'heroicon-o-x-circle',

                                })
                                ->color(fn (string $state): string => match ($state) {
                                    '1' => 'success',
                                    '0' => 'danger',

                                })
                                ->badge()
                                ->iconPosition('after')
                                ->columnSpan(6),

                            TextEntry::make('category.name')
                                ->label('Category')->columnSpan(6),
                            TextEntry::make('type.name')
                                ->label('Type')->columnSpan(4),
                            TextEntry::make('group.name')->columnSpan(8)
                                ->label('Group'),

                            TextEntry::make('created_at')
                                ->label('Uploaded At')
                                ->formatStateUsing(fn ($state) => $state->format('d M Y'))
                                ->dateTime()->columnSpan(6),

                            TextEntry::make('updated_at')
                                ->label('Last Updated At')
                                ->formatStateUsing(fn ($state) => $state->format('d M Y'))
                                ->dateTime()->columnSpan(6),

                            // ye text entry hai

                        ]),

                    ])->columnSpan(4),

                ]),

                TextEntry::make('name')
                    ->label('Product Name')
                    ->columnSpanFull(),

                TextEntry::make('description')
                    ->label('Description')
                    ->columnSpanFull(),


                RepeatableEntry::make('productVariants')
                    ->label('Variants')
                    ->schema([
                        TextEntry::make('sku')
                            ->label('SKU'),

                        TextEntry::make('price')
                            ->label('Price')
                            ->money('INR'),

                        TextEntry::make('quantity')
                            ->label('Quantity'),

                        TextEntry::make('is_base')
                            ->label('Base Variant'),
                    ])
                    ->columns(4),

                RepeatableEntry::make('productImages')
                    ->label('Images')
                    ->schema([
                        ImageEntry::make('image_url')
                            ->label('Image'),

                        TextEntry::make('is_primary')
                            ->label('Primary'),
                    ])
                    ->columns(2),
            ]);

    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'view' => Pages\ViewProduct::route('/{record}/view'),
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
