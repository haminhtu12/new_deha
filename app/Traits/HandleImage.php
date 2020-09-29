<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait HandleImage
{
    public function insertImage($file = null, $pathUploadImage)
    {
        $filename = '';
        if ($file != null && $file != '') {
            $filename = $file->getClientOriginalName();
            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(60, 60);
            $image_resize->save(public_path($pathUploadImage . $filename));
        }
        return $filename;
    }

    public function updateImage($file, $currentFile, $pathUploadImage)
    {
        $filename = $currentFile;
        if ($this->isVerify($file)) {
            if ($currentFile) {
                File::delete($pathUploadImage . $currentFile);
            }
            $filename = $this->insertPhoto($file);
        }
        return $filename;
    }

    public function deleteImage($pathUploadImage, $currentFile)
    {
        File::delete($pathUploadImage . $currentFile);
    }

    public function isVerify($file): bool
    {
        return ($file != null && $file != '');
    }

}
