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
	public function __construct($taskId)
	{
		$this->taskId = $taskId;
	}

	/**
	 * Execute the command.
	 * @param TaskRepository $taskRepository
	 * @param Dispatcher $event
	 */
	public function handle(TaskRepository $taskRepository, Dispatcher $event)
	{
		$task = $taskRepository->findById($this->taskId);

		$taskName = $task->name;
		$projectId = $task->project_id;

		$taskRepository->delete($task);

		$event->fire(new TaskWasDeletedEvent($taskName, $projectId));
	}

}