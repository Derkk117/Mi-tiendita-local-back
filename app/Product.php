<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'user_id', 'description', 'price', 'cost', 'stock', 'image', 'category', 'slug'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at'];
	protected $table = 'products';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function setIdAttribute($value)
	{
		$product = Product::withTrashed()->latest()->first();
		if(is_null($product))
			$sku = 'PRO'.str_pad('1', 3, '0', STR_PAD_LEFT);
		else
			$sku = 'PRO'.str_pad((intval(substr($product->id, 3)) + 1), 3, '0', STR_PAD_LEFT);
		$this->attributes['id'] = $sku;
	}

    public function setSlugAttribute($value)
	{
        $this->attributes['slug'] = Str::slug($this->attributes['name']." ".$this->attributes['category'], '_');
    }

    public function scopeProducts($query, $user)
    {
        return $query->where('user_id', $user->id)->select('id as sku', 
        'name', 'description', 'price', 'cost', 'stock', 'image', 'category');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Sales()
    {
        return $this->belongsToMany('App\Sale');
    }
}
