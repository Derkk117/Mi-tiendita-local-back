<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['client_id', 'name', 'last_name', 'email', 'password', 'payment_method', 'phone', 'client_type'];
    protected $hidden = [];


}
