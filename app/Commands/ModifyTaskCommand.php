<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\TaskModifiedEvent;
use App\Http\Requests\Request;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ModifyTaskCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $taskId
	 */
	public function __construct(Request $request, $taskId, $user)
	{
		$this->name = $request->name;
		$this->description = $request->description;
		$this->memberList = $request->memberList;
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
		$task = $taskRepository->updateTask($this->taskId, [
			'name' => $this->name,
			'description' => $this->description
		]);

		$taskRepository->assignTo($this->memberList, $task);

		$event->fire(new TaskModifiedEvent($task, $this->user));

	}

}
