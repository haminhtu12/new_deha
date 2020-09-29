<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use handleImage;

define('FILE_PATH_PRODUCTIVE', config('pathway.path_upload_image_product_detail'));

class ProductDetails extends Model
{

    protected $table = "product_details";
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function create($data, $image = null)
    {
        $productDetail = '';
        if (isset($image) && $image != '') {
            $data['image'] = $this->insertPhoto($image);
            $productDetail = $this->create($data);
        }
        return $productDetail;
    }

    public function insertPhoto($file = null)
    {
        return $this->insertImage($file, FILE_PATH_PRODUCTIVE);
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
