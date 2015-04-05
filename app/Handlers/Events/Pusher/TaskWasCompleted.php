<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasCompletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskWasCompleted {

	/**
	 * @var Pusher
	 */
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
		$task = $event->task;
		$project = $event->task->project;
		$channel = 'p'.$project->id;
		$partial = view('tasks.partials.task-overview', compact('task', 'project'));

		$this->pusher->trigger($channel, 'taskWasCompleted', [
			'taskId' => $task->id,
			'partial' => (String) $partial,
		]);

	}

}
