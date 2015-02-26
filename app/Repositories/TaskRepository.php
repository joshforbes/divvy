<?php namespace App\Repositories;

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

    public function assignTo(array $members, Task $task)
    {
        $task->users()->attach($members);
    }

}