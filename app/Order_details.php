<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    protected $table = "oder_details";

    public function order_detail()
    {
        return $this->belongsTo(Orders::class, 'orders_id');
    }

    public function product_detail()
    {
        return $this->hasMany(Product_details::class, 'product_details_id');
    }
}
