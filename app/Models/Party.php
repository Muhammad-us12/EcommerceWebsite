<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'partyable_id',
        'partyable_type',
        'opening_balance',
        'balance',
    ];

    public function partyable(): MorphTo
    {
        return $this->morphTo();
    }

    public function updateBalance(float $price, string $type)
    {
        if ($type == 'increment') {
            $this->balance += $price;
        } else {
            $this->balance -= $price;
        }

        $this->save();
    }
}
