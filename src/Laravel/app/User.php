<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'address',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['password','deleted_at','remember_token', 'api_token', 'email_verified_at','id'];

    protected $with = ['orders'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id');
    }

}
