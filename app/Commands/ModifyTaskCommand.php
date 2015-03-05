<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\Request;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class ModifyTaskCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $taskId
	 */
	public function __construct(Request $request, $taskId)
	{
		$this->name = $request->name;
		$this->description = $request->description;
		$this->memberList = $request->memberList;
		$this->taskId = $taskId;
	}

	/**
	 * Execute the command.
	 *
	 * @param TaskRepository $taskRepository
	 */
	public function handle(TaskRepository $taskRepository)
	{
		$task = $taskRepository->updateTask($this->taskId, [
			'name' => $this->name,
			'description' => $this->description
		]);

		$taskRepository->assignTo($this->memberList, $task);
	}

}
