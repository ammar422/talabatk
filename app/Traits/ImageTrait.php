<?php

namespace App\Traits;

trait ImageTrait
{
    public function saveImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = 'images/' . $folder . '/' . $filename;
        return $path;
    }
}
