<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['name','category_id'];
    public function productDetail() {
        return $this->hasMany('App\Product_detail','product_id');
    }
    public function category() {
        return $this->belongsTo('App\Category','category_id','id');
    }

    public function upDateProduct($id,$all=null,$avatar =null){
        $product = Product::findOrFail($id);
        $product ->update($all);
        $avartar = $this->insertPhoto($avatar);
        $product->avatar = $avartar;
        $product->save();


        return $product;
    }
    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        $product->delete();
    }
    public function searchProduct($searchText){
        return Product::select()->where('name','like',"%$searchText%")->get();
    }
    public static function insertPhoto($file =null)
    {
        if($file !=null)
        {
            $filename    = $file->getClientOriginalName();

            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(60, 60);
            $image_resize->save(public_path('images/product/' .$filename));
        }
        return $filename;
    }
//    public function updateProduct(){
//
//    }
}
