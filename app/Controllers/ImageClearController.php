<?php

namespace App\Controllers;

use Intervention\Image\ImageManagerStatic;

trait ImageClearController
{
    protected $file;
    protected $filePath;

    protected function uploadedImageHandler()
    {
        $tempPath = $this->file['tmp_name'];

        if (!getimagesize($tempPath)) {
            return false;
        }

        $publicPathFile = PUBLIC_PATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $this->file['name'];

        $img = ImageManagerStatic::make($this->file['tmp_name']);
        $img->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($publicPathFile);

        if (!file_exists($publicPathFile)) {
            return false;
        }
        $this->filePath = $publicPathFile;
        return true;
    }
}
