<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\Request;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Contracts\Bus\SelfHandling;

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
		$this->members = $request->members;
	}

	/**
	 * Execute the command.
	 *
	 * @param TaskRepository $taskRepository
	 * @return static
	 */
	public function handle(TaskRepository $taskRepository)
	{
		$task = Task::assign([
			'name'        => $this->name,
			'description' => $this->description,
			'project_id'  => $this->projectId,
		]);

		$taskRepository->save($task);

		$taskRepository->assignTo($this->members, $task);

		return $task;
	}

}