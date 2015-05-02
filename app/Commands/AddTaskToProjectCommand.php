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
	protected $memberList;
	protected $projectId;
	protected $members;

	/**
	 * Create a new command instance.
	 *
	 * @param $name
	 * @param $description
	 * @param $memberList
	 * @param $projectId
	 * @param $user
	 */
	public function __construct($name, $description, $memberList, $projectId, $user)
	{
		$this->name = $name;
		$this->description = $description;
		$this->memberList = $memberList;
		$this->projectId = $projectId;
		$this->user = $user;
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
			'is_complete' => 0
		]);

		$taskRepository->save($task);

		$taskRepository->assignTo($this->memberList, $task);

		$event->fire(new TaskAddedToProjectEvent($task, $this->user));

		return $task;
	}

}
