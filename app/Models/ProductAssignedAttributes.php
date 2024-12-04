<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAssignedAttributes extends Model
{
    /** @use HasFactory<\Database\Factories\ProductAssignedAttributesFactory> */
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'value',
        'product_id',
        'adjustable',
        'min_value',
        'max_value',
    ];

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }
}
