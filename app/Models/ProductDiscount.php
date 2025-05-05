<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    protected $fillable = ['product_id', 'discount_type', 'amount', 'title', 'starts_at', 'ends_at', 'is_active'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
