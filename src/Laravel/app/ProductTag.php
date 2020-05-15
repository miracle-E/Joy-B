<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    /**
     * Set auto-increment to false.
     *
     * @var bool
     */
    // public $incrementing = false;

    protected $table ="product_tag";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'tag_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\product', 'product_id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tag', 'tag_id');
    }
}
