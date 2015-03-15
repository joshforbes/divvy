<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\SubtaskWasModifiedEvent;
use App\Http\Requests\Request;
use App\Repositories\SubtaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ModifySubtaskCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 * @param Request $request
	 * @param $subtaskId
	 * @param $user
	 */
	public function __construct(Request $request, $subtaskId, $user)
	{
		$this->name = $request->name;
		$this->subtaskId = $subtaskId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 * @param SubtaskRepository $subtaskRepository
	 * @param Dispatcher $event
	 */
	public function handle(SubtaskRepository $subtaskRepository, Dispatcher $event)
	{
		$subtask = $subtaskRepository->updateTask($this->subtaskId, [
			'name' => $this->name,
		]);

		$event->fire(new SubtaskWasModifiedEvent($subtask, $this->user));

	}

}
