<?php namespace App\Repositories;


use App\Activity;

class ActivityRepository {

    public function findByProjectId($projectId)
    {
        return Activity::with('subject', 'user')->where('project_id', $projectId)->orderBy('created_at', 'desc')->get();
    }

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