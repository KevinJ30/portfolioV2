<?php

namespace App\Services\Images;

use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;

class ImageResizer {

    /**
     * @var int $max_width Largeur maximale de l'image
     **/
    private int $maxSize = 900;

    /**
     * Resize l'image et remplace l'image dans le dossier
     *
     * @param String $image Chemin vers l'image a modifié
     */
    public function resize(string $image) : void {
        $imageResizer = new ImageManager(['driver' => 'gd']);
        $imageResizer = $imageResizer->make($image);

        $imageResizer->resize($this->maxSize, null, function(Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($image);
    }
}
