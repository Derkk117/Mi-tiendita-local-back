<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'name', 'thumbnails', 'image', 'address', 'phone'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at'];
	protected $table = 'stores';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];
    
    public function scopeStores($query)
    {
        return $query;
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }    
    
    public function Address()
    {
        return $this->hasOne('App\Address');
    }
}
