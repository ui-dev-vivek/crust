<?php

namespace App\Filament\MyForms;

use App\Models\Product;
use Filament\Forms;
use Illuminate\Support\Str;

class ProductForm
{
    public static function getProductCreateForm(): array
    {
        return [Forms\Components\Grid::make(12)
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Product Information')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', Str::slug($state));
                                    }),
                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Product::class, 'slug', ignoreRecord: true),

                                Forms\Components\MarkdownEditor::make('description')
                                    ->required()
                                    ->fileAttachmentsDirectory('attachments')
                                    ->fileAttachmentsVisibility('private')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->columnSpan('full'),
                            ]),
                        Forms\Components\Section::make('Product Images')
                            ->collapsible()
                            ->collapsed(true)
                            ->description('Upload your product main image. more then one image can be uploaded.')
                            ->schema([
                                Forms\Components\Repeater::make('images')
                                    ->label('')
                                    ->relationship('images')
                                    ->helperText('Upload your product main image. more then one image can be uploaded.')
                                    ->schema(ProductImageForm::getProductImageForm())
                                    ->columns(3)
                                    ->minItems(1)
                                    ->maxItems(5),
                            ])->columnSpan(2),
                        Forms\Components\Section::make('Product Variants')
                            ->collapsible()
                            ->collapsed(true)
                            ->description('Add your product variants.')
                            ->schema([
                                Forms\Components\Repeater::make('variants')
                                    ->label('')
                                    ->relationship('variants')
                                    ->schema(ProductVariantForm::getProductVariantForm())
                                    ->addActionLabel('Add Variant')
                                    ->columns(3)
                                    ->minItems(1),
                            ])->columnSpan(2),
                        Forms\Components\Section::make('Product SEO')
                            ->collapsible()
                            ->relationship('seo')
                            ->collapsed(true)
                            ->description('Add your product SEO information.')
                            ->schema(ProductSeoForm::getProductSeoForm())->columnSpan(2),
                        Forms\Components\Repeater::make('related_products_id')
                            ->label('Related Products')
                            ->relationship('related')
                            ->schema([
                                Forms\Components\Select::make('related_product_id')
                                    ->label('Related Product')
                                    ->searchable()
                                    ->options(function () {
                                        return Product::pluck('name', 'id'); // Or 'name', based on your column
                                    })
                                    ->preload()
                                    ->reactive(),

                                Forms\Components\TextInput::make('position')
                                    ->label('Position')
                                    ->default(0)
                                    ->numeric(),
                            ])
                            // ->minItems(1)
                            ->addActionLabel('Add Related Product')
                            ->columns(2)
                            ->reorderable()
                            ->collapsible()
                            ->columnSpanFull()
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => 8, 'xl' => 9, 'sm' => 6, 'md' => 6]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status & Category')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->helperText('This product will be hidden id you uncheck this.')
                                    ->label('Active')
                                    ->onIcon('heroicon-m-check-circle')
                                    ->offIcon('heroicon-m-x-circle')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true)
                                    ->required()
                                    ->columnSpanFull()
                                    ->default(true),
                                Forms\Components\Select::make('product_type_id')
                                    ->relationship('type', 'name')
                                    ->required()
                                    ->searchable()
                                    ->label('Product Type')
                                    ->preload()
                                    ->createOptionForm(ProductTypeForm::getProductTypeForm()),
                                Forms\Components\Select::make('product_group_id')
                                    ->relationship('group', 'name')
                                    ->required()
                                    ->searchable()
                                    ->label('Product Group')
                                    ->preload(),
                                // ->createOptionForm(ProductTypeForm::getGroupForm()),
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm(CategoryForm::getCategoryCreateForm()),
                            ]),
                    ])
                    ->columnSpan(['lg' => 4, 'xl' => 3, 'sm' => 6, 'md' => 6]),
            ])];
    }
}
