<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    /** @use HasFactory<\Database\Factories\ProductAttributeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function getProductAttributeValue(int $productId)
    {
        return ProductAssignedAttributes::where('product_id', $productId)
            ->where('attribute_id', $this->id)
            ->first();
    }
}
