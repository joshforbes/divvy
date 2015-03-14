<?php namespace App\Repositories;


use App\Activity;

class ActivityRepository {


    /**
     * Persist an Activity
     *
     * @param Activity $activity
     */
    public function save(Activity $activity)
    {
        $activity->save();
    }

}