<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class history extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['id', 'id_user', 'description', 'date', 'time'];
    protected $hidden = ['updated_at', 'deleted_at', 'id', 'created_at'];
	protected $table = 'histories';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = true;
	protected $dates = ['deleted_at'];

    public function scopeHistories($query, $user)
	{
		return $query->where('id_user', $user->id)->select('id', 'id_user', 'description', 'date', 'time');
	}
}
