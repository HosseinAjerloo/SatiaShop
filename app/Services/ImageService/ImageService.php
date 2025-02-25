<?php

namespace App\Services\ImageService;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService extends ImageProvider
{
//    public function saveImage($image)
//    {
//        $result = $this->getObjFile()->move($this->getAddressFile(), $this->getFinalImageName());
//
//        $imageService = ImageManager::gd()->read($this->getFinalFileAddres());
//
//        dd($imageService);
//        $this->setFileName(time());
//        foreach (config('ImageConfig') as $key => $imagResize) {
//            dd($imagResize,$key);
//        }
//        dd($imageService);
//        $this->setObjFile($image);
//        $this->provider();
//        if ($result) {
//
//            return $this->getFinalFileAddres();
//        }
//        return false;
//    }
    public function saveImage($image)
    {

        $this->setObjFile($image);
        $this->provider();
        $result=$this->getObjFile()->move($this->getAddressFile(),$this->getFinalImageName());
        if ($result)
        {
            return $this->getFinalFileAddres();
        }
        return false;
    }
    public function deleteImage($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
