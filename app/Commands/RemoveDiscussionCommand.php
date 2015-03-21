<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\DiscussionWasDeletedEvent;
use App\Repositories\DiscussionRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class RemoveDiscussionCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param $discussionId
	 * @param $user
	 */
	public function __construct($discussionId, $user)
	{
		$this->discussionId = $discussionId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 * @param DiscussionRepository $discussionRepository
	 * @param Dispatcher $event
	 */
	public function handle(DiscussionRepository $discussionRepository, Dispatcher $event)
	{
		$discussion = $discussionRepository->findById($this->discussionId);

		$discussionRepository->delete($discussion);

		$event->fire(new DiscussionWasDeletedEvent($discussion, $this->user));
	}

}