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
            ->recordUrl(fn($record) => static::getUrl('view', ['record' => $record]))
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable()
                    ->label('Product Name')
                    ->limit(30)
                    ->tooltip(fn(Product $record): string => $record->name),
                // Tables\Columns\TextColumn::make('slug')->wrap(),
                Tables\Columns\ImageColumn::make('primaryImage.image_url')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('total_stock')
                    ->label('Total Stock')
                    ->getStateUsing(fn(Product $record) => $record->variants->sum('quantity'))
                    ->sortable()
                    ->badge()
                    ->color(fn($state) => $state > 0 ? 'success' : 'danger')
                    ->tooltip(function (Product $record) {
                        return $record->variants
                            ->map(fn($variant) => ($variant->sku ?? '') . ': ' . $variant->quantity)
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
        return $infolist->schema([

            // Main Grid Layout
            Grid::make(12)->schema([

                // Left Side - Product Details
                Section::make('Product Details')
                    ->description('Details about the product including name, slug, images, and description.')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->columnSpanFull()
                            ->inlineLabel(),

                        TextEntry::make('slug')
                            ->label('Slug')
                            ->columnSpanFull()
                            ->inlineLabel(),

                        RepeatableEntry::make('images')
                            ->label('Product Images')
                            ->grid(2)
                            ->schema([
                                ImageEntry::make('image_url')
                                    ->label('Image')
                                    ->width('100%')
                                    ->height('100%')
                                    ->columnSpan(12),
                            ])
                            ->columns(1),

                    ])
                    ->columnSpan(8),

                // Right Side - Metadata & Status
                Section::make('Metadata')
                    ->description('Product status and categorization.')
                    ->schema([
                        Grid::make(12)->schema([
                            TextEntry::make('status')
                                ->label('Status')
                                ->formatStateUsing(fn($state) => $state ? 'Published' : 'Unpublished')
                                ->icon(fn($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                                ->color(fn($state) => $state ? 'success' : 'danger')
                                ->badge()
                                ->iconPosition('after')
                                ->columnSpan(6),

                            TextEntry::make('category.name')
                                ->label('Category')
                                ->columnSpan(6),

                            TextEntry::make('type.name')
                                ->label('Type')
                                ->columnSpan(6),

                            TextEntry::make('group.name')
                                ->label('Group')
                                ->columnSpan(6),

                            TextEntry::make('created_at')
                                ->label('Uploaded At')
                                ->formatStateUsing(fn($state) => $state?->format('d M Y'))
                                ->columnSpan(6),

                            TextEntry::make('updated_at')
                                ->label('Last Updated')
                                ->formatStateUsing(fn($state) => $state?->format('d M Y'))
                                ->columnSpan(6),
                        ]),
                    ])
                    ->columnSpan(4),
            ]),

            // Variants Section
            Section::make('Product Variants')
                ->description('Each variant with SKU, price, quantity, base status, attributes, and images.')
                ->schema([
                    RepeatableEntry::make('variants')
                        ->label('Variants')
                        ->schema([
                            Grid::make(4)->schema([
                                TextEntry::make('sku')->label('SKU'),
                                TextEntry::make('price')->label('Price')->money('INR'),
                                TextEntry::make('quantity')->label('Quantity'),
                                TextEntry::make('is_base')
                                    ->label('Base Variant')
                                    ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                                    ->badge()
                                    ->color(fn($state) => $state ? 'success' : 'gray'),
                            ]),

                            // Attributes Block
                            RepeatableEntry::make('attributes')
                                ->label('Attributes')
                                ->grid(4)
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextEntry::make('key')->label(''),
                                        TextEntry::make('value')->label(''),
                                    ]),
                                ])
                                // ->columns(1)
                                ->columnSpanFull(),

                            // Variant Images Block
                            RepeatableEntry::make('images')
                                ->label('Images')
                                ->schema([
                                    ImageEntry::make('image_url')->label('Image')->columnSpanFull(),
                                ])
                                ->columns(2)
                                ->grid(3)
                                ->columnSpanFull(),
                        ])
                        ->columns(1),
                ]),

            // Extra Images Section
            Section::make('Additional Images')
                ->description('More product images with primary indicator.')
                ->schema([
                    RepeatableEntry::make('images')
                        ->schema([
                            ImageEntry::make('image_url')->label('Image'),
                            TextEntry::make('is_primary')->label('Primary'),
                        ])
                        ->columns(2),
                ]),
            Section::make('Description')
                ->description('Product description and details.')
                ->schema([
                    TextEntry::make('description')
                        ->label('Description')
                        ->html()
                        ->columnSpanFull(),
                ]),
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
