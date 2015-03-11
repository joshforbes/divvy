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
        return Task::with('project', 'subtasks', 'discussions.author.profile', 'users.profile')->whereProjectId($projectId)->whereId($taskId)->firstOrFail();
    }


    /**
     * Updates the Task with the given id
     *
     * @param $taskId
     * @param $updatedData
     * @return mixed
     */
    public function updateTask($taskId, $updatedData)
    {
        $task = Task::findOrFail($taskId);
        $task->fill($updatedData)->save();
        return $task;
    }


    /**
     * Assign the task to the specified members
     *
     * @param array $members
     * @param Task $task
     */
    public function assignTo(array $members = null, Task $task)
    {
        if(!$members) {
            return $task->users()->detach();
        }
        return $task->users()->sync($members);
    }

}