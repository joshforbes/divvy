<?php namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ProfilePresenter extends Presenter {

    /**
     * Generate the path for the avatar image
     * @return string
     */
    public function avatar()
    {
        $filename = !is_null($this->avatar_path) ? $this->avatar_path : 'default.jpg';
        return '/images/avatars/' . $filename;
    }

    /**
     * Generate a img tag for the avatar
     *
     * @param string $size
     * @return string
     */
    public function avatarHtml($size = '200px')
    {
        return '<img style="height:' . $size . '; width:' . $size . ';"  src=' . $this->avatar() . '>';
    }

}