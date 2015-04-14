<?php namespace App\Repositories;


use App\Activity;

class ActivityRepository {

    /**
     * find activity by project id
     *
     * @param $projectId
     * @return mixed
     */
    public function findByProjectId($projectId)
    {
        return Activity::with('subject', 'user')->where('project_id', $projectId)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Find activity by task id
     *
     * @param $taskId
     * @return mixed
     */
    public function findByTaskId($taskId)
    {
        return Activity::with('subject', 'user')->where('task_id', $taskId)->orderBy('created_at', 'desc')->get();
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