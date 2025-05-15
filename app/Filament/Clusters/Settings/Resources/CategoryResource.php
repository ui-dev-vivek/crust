<?php

namespace App\Filament\Clusters\Settings\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Clusters\Settings\Resources\CategoryResource\Pages;
use App\Filament\Clusters\Settings\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationLabel = 'Categories';
    protected static ?string $navigationGroup = 'Products Settings';


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
                // Main column (8)
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation !== 'create') {
                                return;
                            }
                            $set('slug', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->disabled()
                        ->dehydrated()
                        ->maxLength(255)
                        ->unique(Category::class, 'slug', ignoreRecord: true),


                    Forms\Components\Select::make('parent_id')
                        ->relationship('parent', 'name')
                        ->helperText('Parent category to which this category belongs.')
                        ->default(null),
                ])->columnSpan(8),

                // Side column (4)
                Forms\Components\Group::make([
                    Forms\Components\Section::make('Status')
                        ->description('Set the status of the category.')
                        ->schema([
                            Forms\Components\Toggle::make('status')
                            ->helperText('Active or Inactive.')
                            ->label('Active')
                            ->onIcon('heroicon-m-check-circle')
                            ->offIcon('heroicon-m-x-circle')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true)
                            ->required(),

                        Forms\Components\FileUpload::make('icon')
                            ->image()
                            ->directory('category-icons')
                            ->visibility('public')
                            ->helperText('Image icon the category.')
                            ->nullable()
                            ->columnSpanFull(),

                        ]),
                  ])->columnSpan(4),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('parent.name')
                    ->label('Parent')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('icon')
                    ->label('Icon'),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true), // hide by default

                    Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->label('Status')
                    ->trueIcon('heroicon-m-check-circle')
                    ->falseIcon('heroicon-m-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
