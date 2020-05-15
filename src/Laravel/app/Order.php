<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Set auto-increment to false.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table ="orders";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'amount',
        'date_created',
        'confirmation_number',
        'user_id',
        'cart_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function cart()
    {
        return $this->belongsTo('App\Cart', 'cart_id');
    }
}
