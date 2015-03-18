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
	 */
	public function __construct($taskId)
	{
		$this->taskId = $taskId;
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

		$event->fire(new TaskWasIncompleteEvent($task));
	}

}
