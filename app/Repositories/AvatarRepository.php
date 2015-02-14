<?php namespace App\Repositories;


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
     * resize it to the proper dimensions and save the file to the
     * avatar images folder
     *
     * @param $image
     * @return Image
     */
    public function upload($image)
    {
        $avatar = $this->imageManager->make($image);

        $this->resize($avatar);

        $this->save($avatar);

        return $avatar;

    }

    /**
     * Resize an InterventionImage object to the proper avatar size
     *
     * @param Image $avatar
     * @return Image
     */
    public function resize(Image $avatar)
    {
        $avatar->resize(null, 200, function ($constraint)
        {
            $constraint->aspectRatio();
        })->crop(200, 200);

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
        \File::delete($this->imagePath . $avatarPath);
    }

}