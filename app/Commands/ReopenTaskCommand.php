<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\TaskWasIncompleteEvent;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ReopenTaskCommand extends Command implements SelfHandling {

	protected $taskId;

	/**
	 * Create a new command instance.
	 *
	 * @param $taskId
	 * @param $user
	 */
	public function __construct($taskId, $user)
	{
		$this->taskId = $taskId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 *
	 * @param TaskRepository $taskRepository
	 * @param Dispatcher $event
	 */
	public function handle(TaskRepository $taskRepository, Dispatcher $event)
	{
		$task = $taskRepository->notComplete($this->taskId);

		$event->fire(new TaskWasIncompleteEvent($task, $this->user));
	}

}
