<?php

namespace App\Filament\MyForms;

use App\Models\Product;
use Filament\Forms;
use Illuminate\Support\Str;

class ProductForm
{
    public static function getProductCreateForm(): array
    {
        return [
            Forms\Components\Grid::make(12)
                ->schema([
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Product Information')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->label('Title of Product')
                                        ->helperText('This will be the title of your product.')
                                        ->placeholder('Soft rose Pillar Candle | Soft Rose | Pack of 2')
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                            if ($operation !== 'create') return;
                                            $set('slug', Str::slug($state));
                                        }),

                                    Forms\Components\TextInput::make('slug')
                                        ->label('Slug')
                                        ->disabled()
                                        ->dehydrated()
                                        ->required()
                                        ->maxLength(255)
                                        ->unique(Product::class, 'slug', ignoreRecord: true),

                                    Forms\Components\RichEditor::make('description')
                                        ->required()
                                        ->fileAttachmentsDirectory('attachments')
                                        ->fileAttachmentsVisibility('private')
                                        ->columnSpanFull(),
                                ]),

                            Forms\Components\Section::make('Product Images')
                                ->collapsible()

                                ->collapsed(true)
                                ->description('Upload your product main image. More than one image can be uploaded.')
                                ->schema([
                                    Forms\Components\Repeater::make('images')
                                        ->relationship('images')
                                        ->label('')
                                        ->grid(2)
                                        ->helperText('Upload multiple product images.')
                                        ->schema(ProductImageForm::getProductImageForm())
                                        ->columns(3)
                                        ->defaultItems(2)
                                        ->createItemButtonLabel('Add Image')
                                        ->maxItems(5)
                                ])
                                ->columnSpan(2),

                            Forms\Components\Section::make('Product Variants')
                                ->collapsible()
                                ->description('Add your product variants.')
                                ->schema([
                                    Forms\Components\Repeater::make('variants')
                                        ->label('')
                                        ->relationship('variants')
                                        ->schema(ProductVariantForm::getProductVariantForm())
                                        ->addActionLabel('Add Variant')
                                        ->columns(3),
                                ])
                                ->columnSpan(2),

                            Forms\Components\Section::make('Product SEO')
                                ->collapsible()
                                ->relationship('seo')
                                ->collapsed(true)
                                ->description('Add your product SEO information.')
                                ->schema(ProductSeoForm::getProductSeoForm())
                                ->columnSpan(2),
                                Forms\Components\Section::make('Related Products')
                                ->collapsed(true)
                                ->collapsible()
                                ->description('Add your product related products.')
                                ->schema([
                            Forms\Components\Repeater::make('related_products')
                                ->label('')
                                ->relationship('related')
                                ->grid(3)
                                ->schema([
                                    Forms\Components\Select::make('related_product_id')
                                        ->label('')
                                        ->searchable()
                                        ->options(Product::pluck('name', 'id'))
                                        ->preload()
                                        ->columnSpanFull()
                                ])
                                ->addActionLabel('Add Related Product')
                                ->columns(2)
                                ->defaultItems(3)

                                ->columnSpanFull(),
                                ]),
                                Forms\Components\Section::make('Custom Fields')
                                ->collapsible()
                                ->collapsed(true)
                                ->description('Custom fields for customization information for your product.')
                                ->schema([
                                Forms\Components\Repeater::make('custom_fields')
                                ->relationship('customFields')
                                ->reorderable()
                                ->orderColumn('sort_order')
                                ->label('')
                                ->defaultItems(0)
                                ->schema([
                                    Forms\Components\TextInput::make('label')
                                        ->required()
                                        ->label('Field Label'),

                                    Forms\Components\Select::make('field_type')
                                        ->label('Field Type')
                                        ->options([
                                            'text' => 'Text',
                                            'number' => 'Number',
                                            'date' => 'Date',
                                            'color' => 'Color',
                                        ])
                                        ->required()
                                        ->label('Field Type'),



                                    Forms\Components\Checkbox::make('is_required')
                                        ->label('Is Required')
                                        ->default(true)
                                        ->inline(false),

                                ])
                                ->columns(4)
                                ->columnSpanFull()
                                ->addActionLabel('Add Custom Field')
                                        ]),
                        ])
                        ->columns(2)
                        ->columnSpan(['lg' => 8, 'xl' => 9, 'sm' => 6, 'md' => 6]),

                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Status & Category')
                                ->schema([
                                    Forms\Components\Toggle::make('status')
                                        ->label('Publish Status')
                                        ->inline(true)
                                        ->onIcon('heroicon-m-check-circle')
                                        ->offIcon('heroicon-m-x-circle')
                                        ->onColor('success')
                                        ->offColor('danger')
                                        ->default(false)
                                        ->helperText('This product will be hidden if you uncheck this.')
                                        ->required()
                                        ->columnSpanFull(),

                                    Forms\Components\Select::make('product_type_id')
                                        ->label('Product Type')
                                        ->relationship('type', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload(),

                                    Forms\Components\Select::make('product_group_id')
                                        ->label('Product Group')
                                        ->relationship('group', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->createOptionForm(ProductGroupForm::getProductGroupForm()),

                                    Forms\Components\Select::make('category_id')
                                        ->label('Category')
                                        ->relationship('category', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->createOptionForm(CategoryForm::getCategoryCreateForm()),
                                ]),

                            Forms\Components\Section::make('Product Badges')
                            ->relationship('badges')

                                ->description('Add your product badges.')
                                ->schema([
                                    Forms\Components\Checkbox::make('is_new')
                                        ->label('New')
                                        ->default(true),

                                    Forms\Components\Checkbox::make('is_featured')
                                        ->label('Featured')
                                        ->default(false),

                                    Forms\Components\Checkbox::make('in_sale')
                                        ->label('In Sale')
                                        ->default(false),

                                    Forms\Components\TextInput::make('custom')
                                        ->label('Custom')
                                        ->nullable()
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columnSpan(['lg' => 4, 'xl' => 3, 'sm' => 6, 'md' => 6]),
                ])
        ];
    }
}
