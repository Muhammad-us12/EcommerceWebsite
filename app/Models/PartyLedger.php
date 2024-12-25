<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'party_id',
        'payment',
        'received',
        'price',
        'balance',
        'ingredient_purchase_id',
        'sale_id',
        'payment_id',
        'recevied_id',
        'remarks',
        'user_id'
    ];
}
