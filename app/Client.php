<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'user_id', 'name', 'last_name', 'email', 'payment_method', 'phone', 'client_type'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at', 'user_id'];
	protected $table = 'clients';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function setIdAttribute($value)
	{
		$client = Client::withTrashed()->latest()->first();
		if(is_null($client))
			$sku = 'CLI'.str_pad('1', 3, '0', STR_PAD_LEFT);
		else
			$sku = 'CLI'.str_pad((intval(substr($client->id, 3)) + 1), 3, '0', STR_PAD_LEFT);
		$this->attributes['id'] = $sku;
	}

	public function scopeClients($query, $user)
	{
		return $query->where('user_id', $user->id)->select('id as sku', 
		'name', 'last_name', 'email', 'phone', 'payment_method', 'client_type');
	}

    public function Sales()
    {
        return $this->hasMany('App\Sale', 'client_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}