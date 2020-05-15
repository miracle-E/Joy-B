<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // /**
    //  * Set auto-increment to false.
    //  *
    //  * @var bool
    //  */
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'label',
    ];


    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
