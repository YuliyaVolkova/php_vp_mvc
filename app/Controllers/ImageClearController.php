<?php

namespace App\Controllers;

use Intervention\Image\ImageManagerStatic;
use Symfony\Component\Filesystem\Filesystem;

trait ImageClearController
{
    protected $file;
    protected $filePath;

    protected function uploadedImageHandler()
    {
        $tempPath = $this->file['tmp_name'];
        $check = getimagesize($tempPath);

        if ($check === false) {
            echo 'Загружено не изображение. ';
        }

        if ($this->file['size'] > 1048576) {
            echo 'Загружайте файлы не более 1 Mб.';
        }

        $tempPath = explode('\\', $tempPath);
        $tempPath[count($tempPath) - 1] = '';
        $tempPath = implode('\\', $tempPath);

        if (preg_match('/jpg/',$this->file['name']) or preg_match('/png/',$this->file['name']) or preg_match('/gif/',$this->file['name']))
        { if (preg_match('/jpg/',$this->file['type']) or preg_match('/png/',$this->file['type']) or preg_match('/gif/',$this->file['type']) or preg_match('/jpeg/',$this->file['type']))
            {
                $publicPathFile = PUBLIC_PATH . DIRECTORY_SEPARATOR . 'uploads/' . $this->file['name'];
                $tempPathFile = $tempPath . DIRECTORY_SEPARATOR . $this->file['name'];

                $img = ImageManagerStatic::make($this->file['tmp_name']);
                $img->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save($tempPathFile);

                $fs = new Filesystem();

                if ($fs->exists($publicPathFile)) {
                    echo 'Файл был загружен ранее. ';
                }

                if ($fs->exists($tempPathFile)) {
                    $fs->copy($tempPathFile, $publicPathFile);
                    $this->filePath = $publicPathFile;
                }
        }
        } else {
            echo 'Этот файл не может быть загружен. ';
        }
    }
}
