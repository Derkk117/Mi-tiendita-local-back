<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sale extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['client_id', 'user_id', 'products', 'payment_method', 'card_number', 'card_cvc', 'expiration_date'];
    protected $hidden = [];

    public function scopeSales($query)
    {
        return $query;
    }
}

