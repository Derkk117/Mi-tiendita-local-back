<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;
    protected $fillable = ['delivery_id','estimated_date','delivered_date','sale_id'];
    protected $hidden = [];

    public function setIdAttribute($value)
	{
		$delivery = Delivery::withTrashed()->latest()->first();
		if(is_null($delivery))
			$sku = 'DEL'.str_pad('1', 3, '0', STR_PAD_LEFT);
		else
			$sku = 'DEL'.str_pad((intval(substr($delivery->id, 3)) + 1), 3, '0', STR_PAD_LEFT);
		$this->attributes['id'] = $sku;
	}

    public function scopeDeliveries($query)
    {
        return $query;
    }

    public function Sales() 
    {
        return $this->belongsTo('App\Sale');
    }

    public function User() 
    {
        return $this->belongsTo('App\User');
    } 
}