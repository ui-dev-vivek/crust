<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'product_type_id',
        'category_id',
        'product_group_id',
        'status'
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    public function badges()
    {
        return $this->hasOne(ProductBadge::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function seo()
    {
        return $this->hasOne(ProductSeo::class);
    }

    public function customFields()
    {
        return $this->hasMany(ProductCustomField::class);
    }

    public function discounts()
    {
        return $this->hasMany(ProductDiscount::class);
    }

    public function related()
    {
        return $this->hasMany(RelatedProduct::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', 1)->latest();
    }
}
