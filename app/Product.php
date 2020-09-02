<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    public function productDetail() {
        return $this->hasMany('App\Product_detail','product_id');
    }
    public function category() {
        return $this->belongsTo('App\Category','category_id','id');
    }
}
