<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    protected $table = "oder_detail";
    public  function order_detail(){
        return $this->belongsTo('App\Orders','orders_id');
    }
    public  function product_detail(){
        return $this->hasMany('App\Product_details','productDetails_id');
    }
}
