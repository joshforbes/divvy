<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasIncompleteEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class ProjectCompletionChanged {

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
	 * @return void
	 */
	public function handle($event)
	{
		$project = $event->project;
		$task = $event->task;
		$channel = 'p'.$project->id;
		$partial = view('tasks.partials.task-progress', compact('project'));

		$this->pusher->trigger($channel, 'projectCompletionChanged', [
			'partial' => (String) $partial
		]);
	}

}
