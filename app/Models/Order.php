<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'order_number',
        'email',
        'phone',
        'order_notes',
        'sub_total',
        'extra_service_total',
        'discount',
        'total_price',
        'status',
        'start_date',
        'end_date',
        'total_days',
    ];

    public function lineItems()
    {
        return $this->hasMany(OrderLineItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function extraPrices()
    {
        return $this->hasMany(OrderExtraPrice::class);
    }

    public function adjustables()
    {
        return $this->hasMany(OrderAdjustable::class);
    }
}
