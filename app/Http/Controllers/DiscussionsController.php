<?php namespace App\Http\Controllers;

use App\Commands\StartDiscussionInTaskCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\DiscussionRequest;
use App\Repositories\DiscussionRepository;
use Illuminate\Http\Request;

class DiscussionsController extends Controller {

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
	 * @param DiscussionRequest $request
	 * @param $projectId
	 * @param $taskId
	 * @return Response
	 */
	public function store(DiscussionRequest $request, $projectId, $taskId)
	{
		$this->dispatch(
			new StartDiscussionInTaskCommand($request, $taskId, $this->user)
		);

		//return redirect()->route('task.show', [$projectId, $taskId]);
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

		return view('discussions.show', compact('discussion', 'task', 'project'));
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
