<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'parent_id', 'icon', 'slug'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->whereNull('parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->whereNotNull('parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

