<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\TaskAddedToProjectEvent;
use App\Http\Requests\Request;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class AddTaskToProjectCommand extends Command implements SelfHandling {

	protected $name;
	protected $description;
	protected $projectId;
	protected $members;

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $projectId
	 */
	public function __construct(Request $request, $projectId)
	{
		$this->name = $request->name;
		$this->description = $request->description;
		$this->projectId = $projectId;
		$this->memberList = $request->memberList;
	}

	/**
	 * Execute the command.
	 *
	 * @param TaskRepository $taskRepository
	 * @param Dispatcher $event
	 * @return static
	 */
	public function handle(TaskRepository $taskRepository, Dispatcher $event)
	{
		$task = Task::assign([
			'name'        => $this->name,
			'description' => $this->description,
			'project_id'  => $this->projectId,
		]);

		$taskRepository->save($task);

		$taskRepository->assignTo($this->memberList, $task);

		$event->fire(new TaskAddedToProjectEvent($task->name, $task->project_id));

		return $task;
	}

}
