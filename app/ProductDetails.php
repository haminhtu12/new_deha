<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

define('FILE_PATH', config('pathupload.path_upload_image_productdetai'));

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

    public function createProductDetails($data, $image = null)
    {
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
            $image_resize->save(public_path(FILE_PATH . $filename));
        }
        return $filename;
    }

    public function updatePhoto($file, $currentFile)
    {
        $filename = $currentFile;
        if ($this->isVerify($file)) {
            if ($currentFile) {
                File::delete(FILE_PATH . $currentFile);
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
