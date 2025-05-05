<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferBanner extends Model
{
    protected $fillable = [
        'title', 'image_url', 'link_url', 'category_id',
        'product_group', 'placement'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group');
    }
}
