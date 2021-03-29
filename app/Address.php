<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    protected $fillable = ['street', 'street2', 'external_number', 'internal_number', 'neighborhood', 'country', 'state', 'zip_code'];
    protected $hidden = [];

    public function scopeAddresses($query)
    {
        return $query;
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'address', 'id');
    }

    public function Supplier()
    {
        return $this->belongsTo('App\Supplier', 'address', 'id');
    }
}