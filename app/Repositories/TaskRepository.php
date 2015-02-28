<?php namespace App\Repositories;

use App\Project;
use App\Task;

class TaskRepository {


    /**
     * Persist a task
     *
     * @param Task $task
     */
    public function save(Task $task)
    {
        $task->save();
    }

    /**
     * Find a Task by the specified Id and Project Id
     *
     * @param $projectId
     * @param $taskId
     * @return mixed
     */
    public function findByIdInProject($projectId, $taskId)
    {
        return Task::whereProjectId($projectId)->whereId($taskId)->firstOrFail();
    }


    /**
     * Assign the task to the specified members
     *
     * @param array $members
     * @param Task $task
     */
    public function assignTo(array $members, Task $task)
    {
        $task->users()->attach($members);
    }

}