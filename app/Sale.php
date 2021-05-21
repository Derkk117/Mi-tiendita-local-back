<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sale extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['id','client_id', 'user_id','products', 'payment_method', 'card_number', 'card_cvc', 'expiration_date','id'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at','client_id','user_id'];
	protected $table = 'sales';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function setIdAttribute($value)
	{
		$sale = Sale::withTrashed()->latest()->first();
        
		if(is_null($sale))
			$sku = 'SALE'.str_pad('1', 3, '0', STR_PAD_LEFT);
		else{
            $sku = 'SALE'.str_pad((intval(substr($sale->id, 4)) + 1), 3, '0', STR_PAD_LEFT);
        }
		$this->attributes['id'] = $sku;
	}

    public function scopeSales($query)
    {
        return $query;
    }

    public function Products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function Delivery(){
        return $this->hasOne('App\Delivery');
    }

    public function Client()
    {
        return $this->belongsTo('App\Client');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

}

