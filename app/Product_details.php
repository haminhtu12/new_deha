<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_details extends Model
{
    protected $table = "product_details";

    public function product_detail()
    {
        return $this->belongsTo(Order_details::class, 'product_details_id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'product_details_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
