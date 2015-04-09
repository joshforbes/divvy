<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskModifiedEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskModified {

	private $pusher;

	/**
	 * Create the event handler.
	 * @param ProjectRepository $projectRepository
	 * @param Pusher $pusher
	 */
	public function __construct(ProjectRepository $projectRepository, Pusher $pusher)
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


		//$partial = view('tasks.partials.task-overview', compact('task', 'project'));

		$this->pusher->trigger($channel, 'taskModified', [
			'taskId' => $task->id,
			'partial' => (String) $partial,
			'members' => $task->users
		]);

	}

}
