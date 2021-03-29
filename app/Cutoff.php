<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cutoff extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'initial_date', 'final_date', 'total'];
    protected $hidden = [];

    public function User() 
    {
        return $this->belongsTo('App\User');
    } 
}
