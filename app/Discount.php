<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = "discounts";

    public function product_detail()
    {
        return $this->belongsTo(Product_details::class, 'product_details_id');
    }
}
