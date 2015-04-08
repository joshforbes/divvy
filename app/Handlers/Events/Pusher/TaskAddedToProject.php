<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskAddedToProject {

	private $pusher;
	/**
	 * @var ProjectRepository
	 */
	private $projectRepository;

	/**
	 * Create the event handler.
	 * @param Pusher $pusher
	 * @param ProjectRepository $projectRepository
	 */
	public function __construct(Pusher $pusher, ProjectRepository $projectRepository)
	{
		$this->pusher = $pusher;
		$this->projectRepository = $projectRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param $event
	 */
	public function handle($event)
	{
		$task = $event->task;
		$project = $event->project;
		$channel = 'p'.$project->id;
		$members = $this->projectRepository->usersInProjectArray($project);

		$partial = view('tasks.partials.task-overview-wrapper', compact('task', 'project', 'members'));

		$this->pusher->trigger($channel, 'taskAddedToProject', [
			'taskId' => $task->id,
			'partial' => (String) $partial,
			'members' => $task->users,
			'admins' => $project->admins
		]);

	}

}
