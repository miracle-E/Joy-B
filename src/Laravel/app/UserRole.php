<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Set auto-increment to false.
     *
     * @var bool
     */
    // public $incrementing = false;

    protected $table ="user_role";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }
}
