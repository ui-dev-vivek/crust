<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGroup extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

