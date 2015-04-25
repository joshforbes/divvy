<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Repositories\ActivityRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
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
	 * @param ProjectRepository $projectRepository
	 * @param $projectId
	 * @return Response
	 */
	public function index(ProjectRepository $projectRepository, $projectId)
	{
		$project = $projectRepository->findByIdForAdmin($projectId);

		$activities = $this->activityRepository->findByProjectIdWithPagination($projectId, 15);

		return view('activity.index', compact('project', 'activities'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param TaskRepository $taskRepository
	 * @param $projectId
	 * @param $taskId
	 * @return Response
	 */
	public function taskIndex(TaskRepository $taskRepository, $projectId, $taskId)
	{
		$task = $taskRepository->findById($taskId);

		$activities = $this->activityRepository->findByTaskIdWithPagination($taskId, 15);

		return view('activity.taskIndex', compact('task', 'activities'));
	}

	/**
	 * Display the activity for the specified user within a Project
	 *
	 * @param ProjectRepository $projectRepository
	 * @param UserRepository $userRepository
	 * @param $projectId
	 * @param $username
	 * @return mixed
	 */
	public function showProject(ProjectRepository $projectRepository, UserRepository $userRepository, $projectId, $username)
	{
		$project = $projectRepository->findByIdForAdmin($projectId);
		$user = $userRepository->findByUsername($username);
		$activities = $this->activityRepository->findByProjectIdForUserWithPagination($user, $projectId, 15);

		return view('activity.showProject', compact('project', 'activities', 'user'));
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
