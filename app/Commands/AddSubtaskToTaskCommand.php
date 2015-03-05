<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\Request;
use App\Repositories\SubtaskRepository;
use App\Subtask;
use Illuminate\Contracts\Bus\SelfHandling;

class AddSubtaskToTaskCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $taskId
	 */
	public function __construct(Request $request, $taskId)
	{
		$this->name = $request->name;
		$this->taskId = $taskId;
	}

	/**
	 * Execute the command.
	 *
	 * @param SubtaskRepository $subtaskRepository
	 */
	public function handle(SubtaskRepository $subtaskRepository)
	{
		$subtask = Subtask::add([
			'name'        => $this->name,
			'isCompleted' => 0,
			'task_id'     => $this->taskId,
		]);

		$subtaskRepository->save($subtask);
	}

}
