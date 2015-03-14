<?php namespace App\Http\Controllers;

use App\Commands\AddSubtaskToTaskCommand;
use App\Commands\LeaveCommentOnSubtaskCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LeaveCommentRequest;
use App\Http\Requests\SubtaskRequest;
use App\Repositories\SubtaskRepository;
use App\Subtask;
use Illuminate\Http\Request;

class SubtasksController extends Controller {

    /**
     * @var SubtaskRepository
     */
    private $subtaskRepository;

    /**
     * @param SubtaskRepository $subtaskRepository
     */
    public function __construct(SubtaskRepository $subtaskRepository)
    {
        parent::__construct();

        $this->subtaskRepository = $subtaskRepository;
    }

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
     * Store a comment in storage and attach it to the subtask
     *
     * @param LeaveCommentRequest $request
     * @param $subtaskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(LeaveCommentRequest $request, $subtaskId)
    {

        $this->dispatch(
            new LeaveCommentOnSubtaskCommand($request, $subtaskId, $this->user->id)
        );

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
        $comments = $subtask->comments;

        return view('subtasks.show', compact('subtask', 'task', 'project', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
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

    public function complete(SubtaskRepository $subtaskRepository, $projectId, $taskId, $subtaskId)
    {
        $subtaskRepository->complete($subtaskId);

        return redirect()->back();
    }

    public function notComplete(SubtaskRepository $subtaskRepository, $projectId, $taskId, $subtaskId)
    {
        $subtaskRepository->notComplete($subtaskId);

        return redirect()->back();
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
