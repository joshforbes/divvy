<?php namespace App\Handlers\Events;

use App\Commands\AddSubtaskToTaskCommand;
use App\Commands\AddTaskToProjectCommand;
use App\Commands\StartDiscussionInTaskCommand;
use App\Commands\StartNewProjectCommand;

use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class BootstrapNewUser {

	private $userRepository;
	private $dispatcher;
	private $auth;
	private $projectRepository;

	private $taskRepository;

	/**
	 * Create the event handler.
	 * @param Dispatcher $dispatcher
	 * @param Guard $auth
	 * @param UserRepository $userRepository
	 * @param ProjectRepository $projectRepository
	 * @param TaskRepository $taskRepository
	 */
	public function __construct(Dispatcher $dispatcher, Guard $auth, UserRepository $userRepository,
								ProjectRepository $projectRepository, TaskRepository $taskRepository)
	{
		$this->dispatcher = $dispatcher;
		$this->auth = $auth;
		$this->userRepository = $userRepository;
		$this->projectRepository = $projectRepository;
		$this->taskRepository = $taskRepository;
	}

	/**
	 * Handle the event.
	 * Going to be a lot of stuff going on here bringing in all the
	 * introductory stuff for a new user
	 *
	 * @param $event
	 */
	public function handle($event)
	{
		$user = $event->user;
		$system = $this->userRepository->findByUsername('system');
		$johndoe = $this->userRepository->findByUsername('johndoe');
		$janedoe = $this->userRepository->findByUsername('janedoe');

		$this->auth->login($user);

		$project = $this->dispatcher->dispatch(
			new StartNewProjectCommand(
				'Explore Divvy',
				'A sample project to help you learn your way around Divvy',
				$system
			)
		);

		$this->projectRepository->addAdmin($user, $project);
		$this->projectRepository->addUser($user, $project);
		$this->projectRepository->addUser($johndoe, $project);
		$this->projectRepository->addUser($janedoe, $project);



		$task = $this->dispatcher->dispatch(
			new AddTaskToProjectCommand(
				'A Task',
				'Tasks are a way to assign work to a group of project members. Only members assigned to the task can see it.',
				[
					0 => $user->id,
					1 => $janedoe->id,
					2 => $johndoe->id
				],
				$project->id,
				$system
			)
		);

		$this->dispatcher->dispatch(
			new AddSubtaskToTaskCommand(
				'Only members assigned to a task can see the task or any activity associated with it.',
				$task->id,
				$system
			)
		);

		$this->dispatcher->dispatch(
			new AddSubtaskToTaskCommand(
				'Clicking another user allows you to see all of their activity within the task.',
				$task->id,
				$janedoe
			)
		);

		$this->dispatcher->dispatch(
			new AddSubtaskToTaskCommand(
				'Project admins can also add subtasks to provide direction to members',
				$task->id,
				$system
			)
		);

		$this->dispatcher->dispatch(
			new AddSubtaskToTaskCommand(
				'Task members can split the Task into smaller subtasks',
				$task->id,
				$johndoe
			)
		);

		$this->dispatcher->dispatch(
			new StartDiscussionInTaskCommand(
				'Discussions allow Task members to collaborate',
				'Any questions about what needs to be done? Discussions are the communication channel to figure out problems and come to solutions.',
				$task->id,
				$janedoe
			)
		);



		$taskCompleted = $this->dispatcher->dispatch(
			new AddTaskToProjectCommand(
				'Another Task',
				'When a task has been finished it can be marked as complete. Something else comes up, just reopen it.',
				[
					0 => $user->id,
					1 => $janedoe->id
				],
				$project->id,
				$system
			)
		);

		$this->taskRepository->complete($taskCompleted->id);

		$this->dispatcher->dispatch(
			new StartDiscussionInTaskCommand(
				'A completed task still contains discussion and completed subtasks',
				'These items become accessible again if the task is reopened. Members can pick up where they left off.',
				$taskCompleted->id,
				$janedoe
			)
		);

	}

}
