<?php namespace App\Http\Controllers;

use App\Commands\AddSubtaskToTaskCommand;
use App\Commands\CompleteSubtaskCommand;
use App\Commands\LeaveCommentOnSubtaskCommand;
use App\Commands\ModifySubtaskCommand;
use App\Commands\RemoveSubtaskCommand;
use App\Commands\ReopenSubtaskCommand;
use App\Events\SubtaskCompletedEvent;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\LeaveCommentRequest;
use App\Http\Requests\SubtaskRequest;
use App\Repositories\SubtaskRepository;
use Request;

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

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }

    /**
     * Store a comment in storage and attach it to the subtask
     *
     * @param LeaveCommentRequest $request
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(LeaveCommentRequest $request, $projectId, $taskId, $subtaskId)
    {

        $this->dispatch(
            new LeaveCommentOnSubtaskCommand($request, $subtaskId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return Response
     */
    public function show($projectId, $taskId, $subtaskId)
    {
        $subtask = $this->subtaskRepository->findByIdInTaskAndProject($subtaskId, $taskId, $projectId);
        $task = $subtask->task;
        $project = $task->project;
        $comments = $subtask->comments;

        return view('subtasks.show', compact('subtask', 'task', 'project', 'comments'));
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

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }


    /**
     * Complete the subtask
     *
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete($projectId, $taskId, $subtaskId)
    {
        $this->dispatch(
            new CompleteSubtaskCommand($subtaskId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }

    /**
     * The subtask was incomplete
     *
     * @param $projectId
     * @param $taskId
     * @param $subtaskId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function incomplete($projectId, $taskId, $subtaskId)
    {
        $this->dispatch(
            new ReopenSubtaskCommand($subtaskId, $this->user)
        );

        if (Request::ajax())
        {
            return response('success', 200);
        }

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

        if (Request::ajax())
        {
            return response('success', 200);
        }

        return redirect()->back();
    }

}
