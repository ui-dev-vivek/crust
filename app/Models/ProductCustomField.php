<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCustomField extends Model
{
    protected $fillable = ['product_id', 'field_type', 'label', 'is_required', 'sort_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function responses()
    {
        return $this->hasMany(OrderCustomFieldResponse::class);
    }
}
