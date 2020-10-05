<?php

namespace App\Model;

use App\Traits\HandleImage;
use Illuminate\Database\Eloquent\Model;

define('FILE_PATH_PRODUCTIVE', config('pathway.path_upload_image_product_detail'));

class ProductDetails extends Model
{
    use HandleImage;

    protected $table = "product_details";
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function createDetail($data, $image = null)
    {
        $data['image'] = $this->insertImage($image, FILE_PATH_PRODUCTIVE);
        return $this->create($data);
    }

    public function updatePhoto($file, $currentFile)
    {
        return $this->updateImage($file, $currentFile, FILE_PATH_PRODUCTIVE);
    }

    public function updateProductDetail($id, $data = null, $image = null)
    {
        $productDetail = $this->findOrFail($id);
        $data['image'] = $this->updatePhoto($image, $productDetail['image']);
        $productDetail->update($data);
        return $productDetail;
    }
//delete

    public function isVerify($file): bool
    {
        return ($file != null && $file != '');
    }

}
