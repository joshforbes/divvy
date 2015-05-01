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
use Request;
use JavaScript;

class DiscussionsController extends Controller {

	public function __construct()
	{
		parent::__construct();
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

		if (Request::ajax())
		{
			return response('success', 200);
		}

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

		if (Request::ajax())
		{
			return response('success', 200);
		}

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

		JavaScript::put([
			'currentUser' => $this->user->username,
			'admins' => $project->admins,
			'channel' => 'd' . $discussion->id,
			'projectChannel' => 'p' . $project->id,
			'taskChannel' => 't' . $task->id
		]);

		return view('discussions.show', compact('discussion', 'task', 'project', 'comments'));
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

		if (Request::ajax())
		{
			return response('success', 200);
		}

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

		if (Request::ajax())
		{
			return response('success', 200);
		}

		return redirect()->back();
	}

}
