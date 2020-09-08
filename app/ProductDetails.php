<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = "product_details";

    public function product_detail()
    {
        return $this->belongsTo(OrderDetails::class, 'product_details_id');
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
