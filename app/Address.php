<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $fillable = ['address_id', 'street', 'external_street', 'internal_street','suburb','state', 'postal_code'];
    protected $hidden = [];

    public function scopeAddresses($query)
    {
        return $query;
    }
}