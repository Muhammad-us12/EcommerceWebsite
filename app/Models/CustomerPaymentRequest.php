<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CustomerPaymentRequest extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'payment_amount',
        'transaction_id',
        'payment_method',
        'invoice_no',
        'payment_date',
        'status',
        'message',
        'customer_id',
        'message',
    ];
}
