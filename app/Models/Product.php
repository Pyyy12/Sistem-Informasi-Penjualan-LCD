<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'os_type',
        'description',
        'price_lcd_only',
        'installation_fee',
        'stock',
        'image',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}