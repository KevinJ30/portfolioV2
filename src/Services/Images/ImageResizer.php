<?php

namespace App\Services\Images;

use App\Entity\Projects;
use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class ImageResizer {

    private string $publicPath;

    public function __construct(KernelInterface $kernel) {
        $this->publicPath = $kernel->getProjectDir() . DIRECTORY_SEPARATOR .'public';
    }

    /**
     * @var int $max_width Largeur maximale de l'image
     **/
    private int $maxSize = 900;

    /**
     * Resize l'image et remplace l'image dans le dossier
     *
     * @param Projects $project
     */
    public function resize(Projects $project) : void {
        $filename = $this->publicPath . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'medias' . DIRECTORY_SEPARATOR. 'images' . DIRECTORY_SEPARATOR . 'projects' . DIRECTORY_SEPARATOR . $project->getThumb();
        $imageResizer = new ImageManager(['driver' => 'gd']);
        $imageResizer = $imageResizer->make($filename);
        $imageResizer->resize($this->maxSize, null, function(Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($filename);
    }
}
