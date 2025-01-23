<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSalePercentage extends Model
{
    /** @use HasFactory<\Database\Factories\VendorSalePercentageFactory> */
    use HasFactory;

    protected $fillable = ['percentage', 'status'];
}
