<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = "categories";
   protected $fillable = ['name'];
    public function products() {
        return $this->hasMany('App\Product','category_id','id');
    }
    public  function createCate($data){
        return $this->create($data) ;
    }
    public  function updateCate($id,$data){
        $category =  $this->find($id);
        return $category->update($data);
    }
    public function deleteCate($id){
        $this->find($id)->delete();
    }
    public function listCate(){
       return $this->all();
    }
}
