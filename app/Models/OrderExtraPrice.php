<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderExtraPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'extra_price_id',
        'value',
    ];

    public function extraPrice()
    {
        return $this->belongsTo(ProductExtraPrice::class, 'extra_price_id');
    }
}
