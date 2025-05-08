<?php

namespace App\Filament\MyForms;

use Filament\Forms;

class ProductImageForm
{

    public static function getProductImageForm(): array
    {
        // protected $fillable = ['product_id', 'image_url', 'is_primary'];
        return [

            Forms\Components\FileUpload::make('image_url')
                ->label('Product Main Image')
                ->image()
                ->imageEditor()
                ->imageEditorMode(2)
                ->imageResizeMode('cover')
                // ->imageResizeMode('cover')
                // ->imageCropAspectRatio('16:9')
                ->directory('products')
                ->visibility('private')
                ->previewable(true)
                ->required()->columnSpanFull(),
            Forms\Components\Toggle::make('is_primary')
                ->label('Primary Image'),

        ];
    }
}
