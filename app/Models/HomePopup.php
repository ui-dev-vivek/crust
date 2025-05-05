<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePopup extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'btn_lable',
        'btn_url',
    ];

    public $timestamps = false;
}
