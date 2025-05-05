<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCrousal extends Model
{
    protected $fillable = [
        'title',
        'image',
        'btn_lable',
        'btn_url',
    ];

    public $timestamps = false;
}
