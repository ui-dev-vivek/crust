<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBadge extends Model
{
    protected $fillable = [
        'product_id', 'is_featured', 'is_new', 'in_sale', 'custom'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
