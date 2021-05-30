<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cutoff extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','user_id', 'initial_date', 'final_date', 'total'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at', 'user_id'];
    protected $table = 'cutoff';
    //public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function setIdAttribute($value)
	{
		// $cutoff = Cutoff::withTrashed()->latest()->first();
		// if(is_null($cutoff))
		// 	$sku = '00'.str_pad('1', 3, '0', STR_PAD_LEFT);
		// else
		// 	$sku = '00'.str_pad((intval(substr($cutoff->id, 3)) + 1), 3, '0', STR_PAD_LEFT);
		// $this->attributes['id'] = $sku;
	}

	public function scopeCutoff($query, $user)
	{
		return $query->where('user_id', $user->id)->select('id as sku', 
		'initial_date', 'final_date', 'total');
	}

    public function Sales()
    {
        return $this->belongsToMany('App\Sale');
    }

    public function User() 
    {
        return $this->belongsTo('App\User');
    } 
}