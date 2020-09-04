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
    public function getIndex() {
        return $this->all();
    }
    public  function createPro($data){
        return $this->create($data) ;
    }
    public  function getEdit($id){
        return $this->find($id) ;
    }
    public  function updatePro($id,$data){
        $product =  $this->find($id);
        return $product->update($data);
    }
    public function deletePro($id){
        $pro   = $this->find($id)->delete();
    }
    public function listPro(){
        return $this->all();
    }





}
