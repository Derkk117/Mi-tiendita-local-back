<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','estimated_date','delivered_date','place', 'status','sale_id'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at', 'sale_id'];
	protected $table = 'deliveries';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function setIdAttribute($value)
	{
		$delivery = Delivery::withTrashed()->latest()->first();
		if(is_null($delivery))
			$sku = 'DEL'.str_pad('1', 3, '0', STR_PAD_LEFT);
		else
			$sku = 'DEL'.str_pad((intval(substr($delivery->id, 3)) + 1), 3, '0', STR_PAD_LEFT);
		$this->attributes['id'] = $sku;
	}

    public function scopeDeliveries($query, $user)
    {
        return $query->where('user_id', $user->id)->select('id as sku', 'place', 'status');
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