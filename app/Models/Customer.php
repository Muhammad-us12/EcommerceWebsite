<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'country',
        'street_address',
        'apartment',
        'phone',
    ];

    public function party(): MorphOne
    {
        return $this->morphOne(Party::class, 'partyable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function paymentRequest()
    {
        return $this->hasMany(CustomerPaymentRequest::class, 'customer_id');
    }
}
