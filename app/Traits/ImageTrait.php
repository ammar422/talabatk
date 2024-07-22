<?php

namespace App\Traits;

trait ImageTrait
{
    public function saveImage($folder, $image)
    {
        $image->store($folder, 'vendor-images');
        $filename = $image->hashName();
        $path = 'images/' . $folder . '/' . $filename;
        return $path;
    }
}
