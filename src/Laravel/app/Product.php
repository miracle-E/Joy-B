<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /**
     * Set auto-increment to false.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table ="products";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'is_available',
        'image',
        'likes'
    ];


    public function getImageAttribute($value)
    {
        return url(Storage::url($value));
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "product_category");
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
