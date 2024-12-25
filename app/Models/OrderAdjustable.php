<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdjustable extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'adjustable_id',
        'adjustable_value',
    ];
}
