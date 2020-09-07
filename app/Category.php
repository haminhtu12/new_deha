<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function createCate($data)
    {
        return $this->create($data);
    }

    public function updateCateGory($id, $data)
    {
        $category = $this->findOrFail($id);
        return $category->update($data);
    }
}
