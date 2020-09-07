<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['name', 'category_id'];

    public function productDetails()
    {
        return $this->hasMany(Product_details::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function getEdit($id)
    {
        return $this->findOrFail($id);
    }

    public function updateProduct($id, $data)
    {
        $product = $this->findOrFail($id);
        return $product->update($data);
    }


}
