<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

define('FILE_PATH_PRODUCTDETAIL', config('pathupload.path_upload_image_productdetai'));

class ProductDetails extends Model
{
    protected $table = "product_details";
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function createProductDetails($data, $image = null)
    {
        if (isset($image) && $image != '') {
            $data['image'] = $this->insertPhoto($image);
            $productDetail = $this->create($data);
        }
        return $productDetail;
    }

    public static function insertPhoto($file = null)
    {
        $filename = '';
        if ($file != null && $file != '') {
            $filename = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(60, 60);
            $image_resize->save(public_path(FILE_PATH_PRODUCTDETAIL . $filename));
        }
        return $filename;
    }

    public function updatePhoto($file, $currentFile)
    {
        $filename = $currentFile;
        if ($this->isVerify($file)) {
            if ($currentFile) {
                File::delete(FILE_PATH_PRODUCTDETAIL . $currentFile);
            }
            $filename = $this->insertPhoto($file);
        }
        return $filename;
    }

    public function upDateProductDetail($id, $data = null, $image = null)
    {
        $productDetail = $this->findOrFail($id);
        $data['image'] = $this->updatePhoto($image, $productDetail['image']);
        $productDetail->update($data);
        return $productDetail;
    }

    public function isVerify($file): bool
    {
        return ($file != null && $file != '');
    }

}
