<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait HandleImage
{
    public function insertImage($file = null, $path)
    {
        $filename = '';
        if ($this->isVerify($file)) {
            $filename =time().'.'. $file->getClientOriginalExtension();
                 Image::make($file)
                ->resize(60, 60)
                ->save($path . $filename);
        }
        return $filename;
    }

    public function updateImage($file, $currentFile, $pathUploadImage)
    {
        $filename = $currentFile;
        if ($this->isVerify($file)) {
            if ($currentFile) {
               $this->deleteImage($pathUploadImage . $currentFile);
            }
            $filename = $this->insertImage($file, $pathUploadImage);
        }
        return $filename;
    }

    public function deleteImage($path)
    {
        if (file_exists($path)) {
            File::delete($path);
        }
    }

    public function isVerify($file): bool
    {
        return ($file != null && $file != '');
    }

}
