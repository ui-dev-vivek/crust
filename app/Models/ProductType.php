<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
