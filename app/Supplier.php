<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    //

    use SoftDeletes;

    protected $fillable = ['name', 'last_name', 'phone' ,'email', 'address'];
    protected $hidden = [];

}
