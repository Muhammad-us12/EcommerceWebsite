<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExtraPrice extends Model
{
    /** @use HasFactory<\Database\Factories\ProductExtraPriceFactory> */
    use HasFactory;

    protected $fillable = [
        'price_id',
        'value',
        'product_id',
    ];
}
