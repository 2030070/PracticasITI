<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    //agregar protect
    protected $fillable = [
        'name',
        'short_description',
        'long_description',
        'sale_price',
        'purchase_price',
        'stock',
        'product_id',
        'fecha',
        'peso',
    ];
}
