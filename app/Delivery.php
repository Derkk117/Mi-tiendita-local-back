<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;
    protected $fillable = ['delivery_id','estimated_date','delivered_date','sale_id'];
    protected $hidden = [];

    public function Sale() 
    {
        return $this->belongsTo('App\Sale');
    }
}
