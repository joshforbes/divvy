<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\SubtaskWasIncompleteEvent;
use App\Repositories\SubtaskRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ReopenSubtaskCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param $subtaskId
	 * @param User $user
	 */
	public function __construct($subtaskId, User $user)
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
		$subtask = $subtaskRepository->notComplete($this->subtaskId);

		$event->fire(new SubtaskWasIncompleteEvent($subtask, $this->user));
	}

}
