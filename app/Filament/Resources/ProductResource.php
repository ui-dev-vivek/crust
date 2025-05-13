<?php

namespace App\Filament\Resources;

use App\Filament\MyForms\ProductForm;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\NumberConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Clusters\Settings;


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
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->wrap(),
                Tables\Columns\TextColumn::make('category.name')->label('Category')->sortable(),
                Tables\Columns\TextColumn::make('type.name')->label('Type')->sortable(),
                Tables\Columns\TextColumn::make('group.name')->label('Group')->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check')
                    ->falseIcon('heroicon-o-x-mark'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y'),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
                TextEntry::make('name')->label('Product Name')->columnSpanFull(),
                TextEntry::make('slug'),
                TextEntry::make('description')->label('Description')->columnSpanFull(),

                TextEntry::make('productType.name')->label('Type'),
                TextEntry::make('category.name')->label('Category'),
                TextEntry::make('productGroup.name')->label('Group'),

                TextEntry::make('status')->label('Active'),
                TextEntry::make('created_at')->dateTime(),
                TextEntry::make('updated_at')->dateTime(),

                RepeatableEntry::make('productVariants')
                    ->label('Variants')
                    ->schema([
                        TextEntry::make('sku'),
                        TextEntry::make('price')->money('INR'),
                        TextEntry::make('quantity'),
                        TextEntry::make('is_base')->label('Base Variant'),
                    ])
                    ->columns(4),

                RepeatableEntry::make('productImages')
                    ->label('Images')
                    ->schema([
                        ImageEntry::make('image_url')->label('Image'),
                        TextEntry::make('is_primary')->label('Primary'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
