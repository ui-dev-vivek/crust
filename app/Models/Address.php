<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'name', 'phone', 'email', 'address_line1', 'address_line2', 'city', 'state', 'country', 'postal_code', 'is_default'];

    public function getFullAddress()
    {
        return $this->address_line1 . ', ' . $this->address_line2 . ', ' . $this->city . ', ' . $this->state . ', ' . $this->country . ', ' . $this->postal_code;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
