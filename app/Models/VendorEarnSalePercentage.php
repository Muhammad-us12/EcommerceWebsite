<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorEarnSalePercentage extends Model
{
    /** @use HasFactory<\Database\Factories\VendorEarnSalePercentageFactory> */
    use HasFactory;

    protected $fillable = ['receivable_amount', 'vendor_id', 'sale_percentage_id', 'order_id'];
}
