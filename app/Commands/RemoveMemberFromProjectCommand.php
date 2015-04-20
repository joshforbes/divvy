<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\MemberRemovedFromProjectEvent;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class RemoveMemberFromProjectCommand extends Command implements SelfHandling {

	private $projectId;
	private $userId;
	private $currentUser;

	/**
	 * Create a new command instance.
	 *
	 * @param $projectId
	 * @param $userId
	 * @param $currentUser
	 */
	public function __construct($projectId, $userId, $currentUser)
	{
		$this->projectId = $projectId;
		$this->userId = $userId;
		$this->currentUser = $currentUser;
	}

	/**
	 * Execute the command.
	 *
	 * @param ProjectRepository $projectRepository
	 * @param UserRepository $userRepository
	 * @param TaskRepository $taskRepository
	 * @param Dispatcher $event
	 */
	public function handle(ProjectRepository $projectRepository, UserRepository $userRepository, TaskRepository $taskRepository, Dispatcher $event)
	{
		$project = $projectRepository->findById($this->projectId);
		$user = $userRepository->findById($this->userId);
		$tasks = $projectRepository->tasksForUserInProject($user->id, $project);

		$projectRepository->removeUser($user, $project);

		foreach($tasks as $task) {
			$taskRepository->removeUser($user, $task);
		}

		$event->fire(new MemberRemovedFromProjectEvent($user, $project, $this->currentUser));

	}

}
