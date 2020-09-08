<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class ProductDetails extends Model
{
    protected $table = "product_details";
    protected $guarded = [];

    public function oder_detai()
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
    public function createProductDetails($data,$image=null){
        $productDetail = new ProductDetails();
        if (isset($image) && $image != '') {
            $data['image'] = $this->insertPhoto($image);
            $productDetail = $this->create($data);
        }
        return $productDetail;
    }
    public static function insertPhoto($file = null)
    {
        $filename = '';
        $path = 'images/productdetails/';
        if ($file != null && $file != '') {
            $filename = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(60, 60);
            $image_resize->save(public_path($path . $filename));
        }
        return $filename;
    }
    public function updatePhoto($file = null){

    }

}
