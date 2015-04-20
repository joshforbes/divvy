<?php namespace App\Repositories;

use App\Project;
use App\Task;
use App\User;

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
     * Find a Task by specified Id
     *
     * @param $taskId
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($taskId)
    {
        return Task::find($taskId);
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
        return Task::with('project', 'activity.user', 'subtasks.comments', 'discussions.author', 'discussions.comments', 'users.profile')->whereProjectId($projectId)->whereId($taskId)->firstOrFail();
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

    /**
     * Delete a Task by Id
     *
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById($id)
    {
        return Task::find($id)->delete();
    }

    /**
     * Delete by model
     * @param Task $task
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Task $task)
    {
        return $task->delete();
    }

    /**
     * Marks the specified task as complete
     *
     * @param $taskId
     * @return bool
     */
    public function complete($taskId)
    {
        $task = Task::find($taskId);

        $task->is_complete = 1;

        $task->save();

        return $task;
    }

    /**
     * Marks the specified task as not completed
     *
     * @param $taskId
     * @return bool
     */
    public function notComplete($taskId)
    {
        $task = Task::find($taskId);

        $task->is_complete = 0;

        $task->save();

        return $task;
    }

    /**
     * Removes a user from the specified task
     *
     * @param User $user
     * @param Task $task
     */
    public function removeUser(User $user, Task $task)
    {
        $task->users()->detach([$user->id]);
    }

}