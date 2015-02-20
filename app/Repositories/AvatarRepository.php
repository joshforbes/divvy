<?php namespace App\Repositories;


use File;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class AvatarRepository {

    /**
     * The public path where Avatar images are stored
     * @var string
     */
    protected $imagePath;

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
     * @return Image
     */
    public function create($file)
    {
        return $this->imageManager->make($file);
    }

    /**
     * Resize an InterventionImage object to the proper avatar size
     *
     * @param Image $avatar
     * @param int $size
     * @return Image
     */
    public function resizeAndCrop(Image $avatar, $size = 200)
    {
        $avatar->resize(null, $size, function ($constraint)
        {
            $constraint->aspectRatio();
        })->crop($size, $size);

        return $avatar;
    }

    /**
     * Save an InterventionImage object to the avatar folder
     * and give it a unique name
     *
     * @param Image $avatar
     * @return Image
     */
    public function save(Image $avatar)
    {
        return $avatar->save($this->imagePath . uniqid() . '.jpg');
    }

    /**
     * Delete an Avatar file
     *
     * @param $avatarPath
     */
    public function delete($avatarPath)
    {
        File::delete($this->imagePath . $avatarPath);
    }

}