<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\DiscussionWasModifiedEvent;
use App\Http\Requests\Request;
use App\Repositories\DiscussionRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ModifyDiscussionCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 * @param Request $request
	 * @param $discussionId
	 * @param $user
	 */
	public function __construct(Request $request, $discussionId, $user)
	{
		$this->title = $request->title;
		$this->body = $request->body;
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
		$discussion = $discussionRepository->updateDiscussion($this->discussionId, [
			'title' => $this->title,
			'body' => $this->body
		]);

		$event->fire(new DiscussionWasModifiedEvent($discussion, $this->user));

	}

}
