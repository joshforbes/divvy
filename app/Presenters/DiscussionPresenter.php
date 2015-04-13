<?php namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class DiscussionPresenter extends Presenter {


    /**
     * Truncate a long discussion title for discussion overview
     *
     * @param int $length
     * @return string
     */
    public function truncatedTitle($length = 40)
    {
        if (strlen($this->title) > $length) {
            return substr($this->title, 0, $length) . '...';
        }

        return $this->title;
    }

}