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
		$task = $event->task;
		$project = $event->project;
		$channel = 'p'.$project->id;

		$this->pusher->trigger($channel, 'taskWasDeleted', [
			'taskId' => $task->id,
		]);

	}

}
