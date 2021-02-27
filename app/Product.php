<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'user_id', 'description', 'price', 'cost', 'stock', 'image', 'category'];
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
