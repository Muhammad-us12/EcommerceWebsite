<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLineItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'price_for_total_days',
        'security_deposit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
