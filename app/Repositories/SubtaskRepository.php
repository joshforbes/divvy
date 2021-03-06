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

        $subtask->is_complete = 1;

        $subtask->save();

        return $subtask;
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

        $subtask->is_complete = 0;

        $subtask->save();

        return $subtask;
    }

    /**
     * Find a Subtask by the specified Id
     *
     * @param $subtaskId
     * @return mixed
     */
    public function findByIdInTaskAndProject($subtaskId, $taskId, $projectId)
    {
        $subtask = Subtask::with('task.project', 'comments.author.profile')
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

    /**
     * Delete a subtask by Id
     *
     * @param $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById($id)
    {
        return Subtask::find($id)->delete();
    }

    /**
     * Delete by model
     *
     * @param $subtask
     * @return bool|null
     */
    public function delete(Subtask $subtask)
    {
        return $subtask->delete();
    }

    /**
     * Updates the Subtask with the given id
     *
     * @param $subtaskId
     * @param $updatedData
     * @return mixed
     */
    public function updateTask($subtaskId, $updatedData)
    {
        $subtask = Subtask::findOrFail($subtaskId);
        $subtask->fill($updatedData)->save();
        return $subtask;
    }

}

