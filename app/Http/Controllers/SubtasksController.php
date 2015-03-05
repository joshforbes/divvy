<?php namespace App\Http\Controllers;

use App\Commands\AddSubtaskToTaskCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SubtaskRequest;
use App\Repositories\SubtaskRepository;
use App\Subtask;
use Illuminate\Http\Request;

class SubtasksController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param SubtaskRequest $request
     * @param $projectId
     * @param $taskId
     * @return Response
     */
    public function store(SubtaskRequest $request, $projectId, $taskId)
    {
        $this->dispatch(
            new AddSubtaskToTaskCommand($request, $taskId)
        );

        //return redirect()->route('task.show', [$projectId, $taskId]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param SubtaskRepository $subtaskRepository
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return Response
     */
    public function show(SubtaskRepository $subtaskRepository, $projectId, $taskId, $subtaskId)
    {
        $subtask = $subtaskRepository->findByIdInTaskAndProject($subtaskId, $taskId, $projectId);
        $task = $subtask->task;
        $project = $task->project;

        return view('subtasks.show', compact('subtask', 'task', 'project'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SubtaskRepository $subtaskRepository
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return Response
     * @internal param int $id
     */
    public function destroy(SubtaskRepository $subtaskRepository, $projectId, $taskId, $subtaskId)
    {
        $subtaskRepository->deleteById($subtaskId);

        return redirect()->back();
    }

}
