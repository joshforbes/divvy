<?php namespace App\Http\Controllers;

use App\Commands\AddSubtaskToTaskCommand;
use App\Commands\LeaveCommentOnSubtaskCommand;
use App\Commands\ModifySubtaskCommand;
use App\Commands\RemoveSubtaskCommand;
use App\Events\SubtaskCompletedEvent;
use App\Events\SubtaskWasCompletedEvent;
use App\Events\SubtaskWasIncompleteEvent;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LeaveCommentRequest;
use App\Http\Requests\SubtaskRequest;
use App\Repositories\SubtaskRepository;
use App\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            new AddSubtaskToTaskCommand($request, $taskId, $this->user)
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
            new LeaveCommentOnSubtaskCommand($request, $subtaskId, $this->user)
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
     * @param SubtaskRequest $request
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubtaskRequest $request, $projectId, $taskId, $subtaskId)
    {
        $this->dispatch(
            new ModifySubtaskCommand($request, $subtaskId, $this->user)
        );

        return redirect()->back();
    }



    public function complete(SubtaskRepository $subtaskRepository, $projectId, $taskId, $subtaskId)
    {
        $subtask = $subtaskRepository->complete($subtaskId);

        \Event::fire(new SubtaskWasCompletedEvent($subtask, $this->user));

        return redirect()->back();
    }

    public function notComplete(SubtaskRepository $subtaskRepository, $projectId, $taskId, $subtaskId)
    {
        $subtask = $subtaskRepository->notComplete($subtaskId);

        \Event::fire(new SubtaskWasIncompleteEvent($subtask, $this->user));

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return Response
     * @internal param int $id
     */
    public function destroy($projectId, $taskId, $subtaskId)
    {
        $this->dispatch(
            new RemoveSubtaskCommand($subtaskId, $this->user)
        );

        return redirect()->back();
    }

}
