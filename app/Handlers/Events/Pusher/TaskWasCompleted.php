<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasCompletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskWasCompleted {
	
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
		$this->handleProject($event);

		$this->handleTask($event);
	}

	/**
	 * handles events related to the Project page/channel
	 *
	 * @param $event
	 * @throws \PusherException
	 */
	private function handleProject($event)
	{
		$task = $event->task;
		$project = $event->project;
		$channel = 'p'.$project->id;
		$partial = view('tasks.partials.task-overview', compact('task', 'project'));

		$this->pusher->trigger($channel, 'taskWasCompleted', [
			'taskId' => $task->id,
			'partial' => (String) $partial,
		]);
	}

	/**
	 * handles events related to the Task page/channel
	 *
	 * @param $event
	 * @throws \PusherException
	 */
	private function handleTask($event)
	{
		$task = $event->task;
		$channel = 't'.$task->id;
		$partial = view('layouts.partials.completed-overlay');

		$this->pusher->trigger($channel, 'taskWasCompleted', [
			'partial' => (String) $partial,
		]);
	}

}
