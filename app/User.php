<?php

namespace App;

use App\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = ['name', 'last_name', 'email', 'password', 'address'];
    protected $hidden = ['password', 'remember_token',];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }
}
