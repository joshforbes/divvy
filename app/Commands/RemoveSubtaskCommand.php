<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\SubtaskWasDeletedEvent;
use App\Repositories\SubtaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class RemoveSubtaskCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param $subtaskId
	 * @param $user
	 */
	public function __construct($subtaskId, $user)
	{
		$this->subtaskId = $subtaskId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 *
	 * @param SubtaskRepository $subtaskRepository
	 * @param Dispatcher $event
	 */
	public function handle(SubtaskRepository $subtaskRepository, Dispatcher $event)
	{
		$subtask = $subtaskRepository->findById($this->subtaskId);

		$subtaskRepository->delete($subtask);

		$event->fire(new SubtaskWasDeletedEvent($subtask, $this->user));
	}

}
