<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = "discount";
    public  function product_detail(){
        return $this->belongsTo('App\Product_details','productDetails_id');
    }
}
