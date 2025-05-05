<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $fillable = ['name','slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
