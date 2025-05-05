<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCustomFieldResponse extends Model
{
    protected $fillable = ['order_item_id', 'product_custom_field_id', 'response_text'];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function field()
    {
        return $this->belongsTo(ProductCustomField::class, 'product_custom_field_id');
    }
}
