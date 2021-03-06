<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\TaskWasDeletedEvent;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class RemoveTaskCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param $taskId
	 */
	public function __construct($taskId, $user)
	{
		$this->taskId = $taskId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 * @param TaskRepository $taskRepository
	 * @param Dispatcher $event
	 */
	public function handle(TaskRepository $taskRepository, Dispatcher $event)
	{
		$task = $taskRepository->findById($this->taskId);

		$taskRepository->delete($task);

		$event->fire(new TaskWasDeletedEvent($task, $this->user));
	}

}