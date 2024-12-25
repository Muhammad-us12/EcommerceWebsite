<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Vendor extends Model
{
    /** @use HasFactory<\Database\Factories\VendorFactory> */
    use HasFactory;

    protected $fillable = [
        'phone', 'address', 'city', 'cnic', 'user_id',
        'gender', 'bank_account_number', 'bank_name',
    ];

    public function party(): MorphOne
    {
        return $this->morphOne(Party::class, 'partyable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
