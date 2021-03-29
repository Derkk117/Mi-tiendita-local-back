<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'last_name', 'phone' ,'email', 'address', 'slug'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at'];
	protected $table = 'clients';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function setIdAttribute($value)
	{
		$supplier = Supplier::withTrashed()->latest()->first();
		if(is_null($supplier))
			$sku = 'SUP'.str_pad('1', 3, '0', STR_PAD_LEFT);
		else
			$sku = 'SUP'.str_pad((intval(substr($supplier->id, 3)) + 1), 3, '0', STR_PAD_LEFT);
		$this->attributes['id'] = $sku;
	}

    public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = Str::slug($value);
	}

    public function scopeSuppliers($query)
    {
        return $query;
    }

    public function Users()
    {
        return $this->belongsToMany('App\User');
    }

    public function Address()
    {
        return $this->hasOne('App\Address');
    }
}
