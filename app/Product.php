<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $primaryKey='id';
    protected $table='products';
    protected $fillable = [
        'title' , 'price', 'description','image','category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
