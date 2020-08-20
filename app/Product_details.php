<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_details extends Model
{
    protected $table = "product_detail";
    public  function product_detail(){
        return $this->belongsTo('App\Order_details','productDetails_id');
    }
    public  function discount(){
        return $this->hasOne('App\Discount','productDetails_id');
    }
    public function product() {
        return $this->belongsTo('App\Product','product_id');
    }
}
