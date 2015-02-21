<?php namespace App;

use File;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class Avatar {

    /**
     * The public path where Avatar images are stored
     * @var string
     */
    protected $imagePath;


    /**
     * The intervention image object
     * @var
     */
    protected $image;

    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @param ImageManager $imageManager
     */
    function __construct(ImageManager $imageManager)
    {
        $this->imagePath = public_path() . '/images/avatars/';
        $this->imageManager = $imageManager;
    }


    /**
     * Take an image input from the User, make an InterventionImage Object
     *
     * @param $file
     * @return $this
     */
    public function create($file)
    {
        $this->image = $this->imageManager->make($file);

        return $this;
    }

    /**
     * Resize an InterventionImage object to the proper avatar size
     *
     * @param int $size
     * @return $this
     */
    public function resizeAndCrop($size = 200)
    {
        $this->image->resize(null, $size, function ($constraint)
        {
            $constraint->aspectRatio();
        })->crop($size, $size);

        return $this;
    }

    /**
     * Save the image to the avatar folder
     * and give it a unique name
     *
     * @return bool
     */
    public function save()
    {
        $filename = $this->imagePath . uniqid() . 'jpg';
        $this->image->save($filename);

        return file_exists($filename);
    }

    /**
     * Delete an Avatar file
     *
     * @param $avatarPath
     *
     * @return bool
     */
    public function delete($avatarPath)
    {
        return File::delete($this->imagePath . $avatarPath);
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

}