<?php namespace App\Repositories;


use App\Subtask;
use App\Task;

class SubtaskRepository {


    /**
     * Persist a subtask
     *
     * @param Subtask $subtask
     */
    public function save(Subtask $subtask)
    {
        $subtask->save();
    }

    /**
     * Marks the specified subtask complete
     *
     * @param $subtaskId
     * @return bool
     */
    public function complete($subtaskId)
    {
        $subtask = Subtask::find($subtaskId);

        $subtask->isCompleted = 1;

        return $subtask->save();
    }

    /**
     * Marks the specified subtask as not completed
     *
     * @param $subtaskId
     * @return bool
     */
    public function notComplete($subtaskId)
    {
        $subtask = Subtask::find($subtaskId);

        $subtask->isCompleted = 0;

        return $subtask->save();
    }



    /**
     * Find a Subtask by the specified Id
     *
     * @param $subtaskId
     * @return mixed
     */
    public function findByIdInTaskAndProject($subtaskId, $taskId, $projectId)
    {
        $subtask = Subtask::with('task.project')
            ->whereHas('task', function($q) use($taskId){
                $q->whereId($taskId);
            })
            ->whereHas('task.project', function($q) use($projectId){
                $q->whereId($projectId);
            })
            ->findOrFail($subtaskId);

        return $subtask;
    }


    /**
     * Find a subtask by specified Id
     *
     * @param $subtaskId
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($subtaskId)
    {
        return Subtask::find($subtaskId);
    }

    public function deleteById($id)
    {
        return Subtask::find($id)->delete();
    }

}

