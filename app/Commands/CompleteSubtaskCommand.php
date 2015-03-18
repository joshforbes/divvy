<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\SubtaskWasCompletedEvent;
use App\Repositories\SubtaskRepository;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class CompleteSubtaskCommand extends Command implements SelfHandling {

	protected $subtaskId;
	protected $user;

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
		$subtask = $subtaskRepository->complete($this->subtaskId);

		$event->fire(new SubtaskWasCompletedEvent($subtask, $this->user));
	}

}
