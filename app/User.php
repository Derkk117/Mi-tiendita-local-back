<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    protected $fillable = ['name', 'last_name', 'email', 'password', 'address', 'store'];
    protected $hidden = ['password', 'remember_token',];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
    public function scopeUsers($query)
    {
        return $query;
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'user_id', 'id');
    }

    public function Clients()
    {
        return $this->hasMany('App\Client', 'user_id', 'id');
    }

    public function Sales()
    {
        return $this->hasMany('App\Sale', 'user_id', 'id');
    }
    
    public function Cutoffs() {
        return $this->hasMany('App\Cutoff', 'user_id', 'id');
    }

    public function Suppliers()
    {
        return $this->belongsToMany('App\Supplier');
    }

    public function Address()
    {
        return $this->hasOne('App\Address', 'id', 'address');
    }

    public function Store()
    {
        return $this->hasOne('App\Store', 'id', 'store_id');
    }
}
