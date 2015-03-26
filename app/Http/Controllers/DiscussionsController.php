<?php namespace App\Http\Controllers;

use App\Commands\LeaveCommentOnDiscussionCommand;
use App\Commands\ModifyDiscussionCommand;
use App\Commands\RemoveDiscussionCommand;
use App\Commands\StartDiscussionInTaskCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CreateDiscussionRequest;
use App\Http\Requests\EditDiscussionRequest;
use App\Http\Requests\LeaveCommentRequest;
use App\Repositories\DiscussionRepository;
use Illuminate\Http\Request;

class DiscussionsController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateDiscussionRequest|DiscussionRequest $request
	 * @param $projectId
	 * @param $taskId
	 * @return Response
	 */
	public function store(CreateDiscussionRequest $request, $projectId, $taskId)
	{
		$this->dispatch(
			new StartDiscussionInTaskCommand($request, $taskId, $this->user)
		);

		//return redirect()->route('task.show', [$projectId, $taskId]);
		return redirect()->back();
	}

	/**
	 * Store a comment in storage and attach it to the discussion
	 * @param LeaveCommentRequest $request
	 * @param $projectId
	 * @param $taskId
	 * @param $discussionId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function storeComment(LeaveCommentRequest $request, $projectId, $taskId, $discussionId)
	{

		$this->dispatch(
			new LeaveCommentOnDiscussionCommand($request, $discussionId, $this->user)
		);

		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param DiscussionRepository $discussionRepository
	 * @param $projectId
	 * @param $taskId
	 * @param $discussionId
	 * @return Response
	 */
	public function show(DiscussionRepository $discussionRepository, $projectId, $taskId, $discussionId)
	{
		$discussion = $discussionRepository->findByIdInTaskAndProject($discussionId, $taskId, $projectId);
		$task = $discussion->task;
		$project = $task->project;
		$comments = $discussion->comments;

		return view('discussions.show', compact('discussion', 'task', 'project', 'comments'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * @param EditDiscussionRequest $request
	 * @param $projectId
	 * @param $taskId
	 * @param $discussionId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(EditDiscussionRequest $request, $projectId, $taskId, $discussionId)
	{
		$this->dispatch(
			new ModifyDiscussionCommand($request, $discussionId, $this->user)
		);

		return redirect()->back();
	}


	/**
	 * Remove the specified resource from storage.
	 * @param $projectId
	 * @param $taskId
	 * @param $discussionId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($projectId, $taskId, $discussionId)
	{
		$this->dispatch(
			new RemoveDiscussionCommand($discussionId, $this->user)
		);

		return redirect()->back();
	}

}
