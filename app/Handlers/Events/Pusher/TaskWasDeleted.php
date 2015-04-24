<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasDeletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskWasDeleted {

	private $pusher;

	/**
	 * Create the event handler.
	 * @param Pusher $pusher
	 */
	public function __construct(Pusher $pusher)
	{
		$this->pusher = $pusher;
	}

	/**
	 * Handle the event.
	 *
	 * @param $event
	 */
	public function handle($event)
	{
		$this->projectHandler($event);

		$this->taskHandler($event);
	}

	/**
	 * Handles events related to the projects page
	 * @param $event
	 * @throws \PusherException
	 */
	protected function projectHandler($event)
	{
		$task = $event->task;
		$project = $event->project;
		$channel = 'p'.$project->id;

		$this->pusher->trigger($channel, 'taskWasDeleted', [
			'taskId' => $task->id,
		]);
	}

	/**
	 * Handles events related to the task page
	 * @param $event
	 * @throws \PusherException
	 */
	protected function taskHandler($event)
	{
		$project = $event->project;
		$task = $event->task;
		$channel = 't'.$task->id;
		$partial = view('tasks.partials.task-removed', compact('project'));


		$this->pusher->trigger($channel, 'taskWasDeleted', [
			'partial' => (String) $partial
		]);
	}

}
