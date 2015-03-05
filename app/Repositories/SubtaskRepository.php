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

    public function deleteById($id)
    {
        return Subtask::find($id)->delete();
    }

}

