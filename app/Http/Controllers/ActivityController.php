<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ActivityRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller {

	/**
	 * @param ActivityRepository $activityRepository
     */
	function __construct(ActivityRepository $activityRepository)
	{
		$this->activityRepository = $activityRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $projectId
	 * @return Response
	 */
	public function index($projectId)
	{
		$activity = $this->activityRepository->findByProjectId($projectId);

		return view('activity.index', compact('activity'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $taskId
	 * @return Response
	 */
	public function taskIndex($taskId)
	{
		$activity = $this->activityRepository->findByTaskId($taskId);

		return view('activity.index', compact('activity'));
	}

	/**
	 * Display the activity for the specified user within a Project
	 *
	 * @param UserRepository $userRepository
	 * @param $projectId
	 * @param $username
	 * @return mixed
     */
	public function showProject(UserRepository $userRepository, $projectId, $username)
	{
		$user = $userRepository->findByUsername($username);
		$activity = $this->activityRepository->findByProjectIdForUser($user, $projectId);

		return view('activity.showProject', compact('activity', 'user'));
	}

	/**
	 * Display the activity for the specified user within a task
	 *
	 * @param UserRepository $userRepository
	 * @param $projectId
	 * @param $taskId
	 * @param $username
	 * @return mixed
	 */
	public function showTask(UserRepository $userRepository, $projectId, $taskId, $username)
	{
		$user = $userRepository->findByUsername($username);
		$activity = $this->activityRepository->findByTaskIdForUser($user, $taskId);

		return view('activity.index', compact('activity', 'user'));
	}


}
