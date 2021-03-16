<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cutoff extends Model
{
    use SoftDeletes;
    protected $fillable = ['client_id', 'initial_date', 'final_date', 'total'];
    protected $hidden = [];


}
