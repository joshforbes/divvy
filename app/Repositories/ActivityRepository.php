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
     * find activity by project id with pagination
     *
     * @param $projectId
     * @param $numberPerPage
     * @return mixed
     */
    public function findByProjectIdWithPagination($projectId, $numberPerPage)
    {
        return Activity::with('subject', 'user')->where('project_id', $projectId)->orderBy('created_at', 'desc')->paginate($numberPerPage);
    }

    /**
     * find activity by project id for specified user
     *
     * @param $user
     * @param $projectId
     * @return mixed
     */
    public function findByProjectIdForUser($user, $projectId)
    {
        return Activity::with('subject', 'user')->where('project_id', $projectId)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * find activity by project id for specified user
     *
     * @param $user
     * @param $projectId
     * @param $numberPerPage
     * @return mixed
     */
    public function findByProjectIdForUserWithPagination($user, $projectId, $numberPerPage)
    {
        return Activity::with('subject', 'user')->where('project_id', $projectId)->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate($numberPerPage);
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
     * Find activity by task id with pagination
     *
     * @param $taskId
     * @param $numberPerPage
     * @return mixed
     */
    public function findByTaskIdWithPagination($taskId, $numberPerPage)
    {
        return Activity::with('subject', 'user')->where('task_id', $taskId)->orderBy('created_at', 'desc')->paginate($numberPerPage);
    }

    /**
     * Find activity by task id for a specified user
     *
     * @param $user
     * @param $taskId
     * @return mixed
     */
    public function findByTaskIdForUser($user, $taskId)
    {
        return Activity::with('subject', 'user')->where('task_id', $taskId)->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
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