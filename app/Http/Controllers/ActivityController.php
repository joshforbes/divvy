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

	private $projectRepository;
	private $activityRepository;
	private $taskRepository;
	private $userRepository;

	/**
	 * @param ActivityRepository $activityRepository
	 * @param ProjectRepository $projectRepository
	 * @param TaskRepository $taskRepository
	 * @param UserRepository $userRepository
	 */
	function __construct(ActivityRepository $activityRepository, ProjectRepository $projectRepository, TaskRepository $taskRepository, UserRepository $userRepository)
	{
		$this->activityRepository = $activityRepository;
		$this->projectRepository = $projectRepository;
		$this->taskRepository = $taskRepository;
		$this->userRepository = $userRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $projectId
	 * @return Response
	 */
	public function index($projectId)
	{
		$project = $this->projectRepository->findByIdForAdmin($projectId);

		$activities = $this->activityRepository->findByProjectIdWithPagination($projectId, 15);

		return view('activity.index', compact('project', 'activities'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $projectId
	 * @param $taskId
	 * @return Response
	 */
	public function taskIndex($projectId, $taskId)
	{
		$task = $this->taskRepository->findById($taskId);

		$activities = $this->activityRepository->findByTaskIdWithPagination($taskId, 15);

		return view('activity.taskIndex', compact('task', 'activities'));
	}

	/**
	 * Display the activity for the specified user within a Project
	 *
	 * @param $projectId
	 * @param $username
	 * @return mixed
	 */
	public function showProject($projectId, $username)
	{
		$project = $this->projectRepository->findByIdForAdmin($projectId);
		$user = $this->userRepository->findByUsername($username);
		$activities = $this->activityRepository->findByProjectIdForUserWithPagination($user, $projectId, 15);

		return view('activity.showProject', compact('project', 'activities', 'user'));
	}

	/**
	 * Display the activity for the specified user within a task
	 *
	 * @param $projectId
	 * @param $taskId
	 * @param $username
	 * @return mixed
	 */
	public function showTask($projectId, $taskId, $username)
	{
		$task = $this->taskRepository->findById($taskId);
		$user = $this->userRepository->findByUsername($username);
		$activities = $this->activityRepository->findByTaskIdForUserWithPagination($user, $taskId, 15);

		return view('activity.showTask', compact('activities', 'user', 'task'));
	}


}
