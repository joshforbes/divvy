<?php namespace App\Commands;

use App\Commands\Command;

use App\Comment;
use App\Events\CommentWasLeftEvent;
use App\Events\CommentWasLeftOnDiscussionEvent;
use App\Http\Requests\Request;
use App\Repositories\DiscussionRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class LeaveCommentOnDiscussionCommand extends Command implements SelfHandling {

	protected $body;
	protected $discussionId;
	protected $user;

	/**
	 * Create a new command instance.
	 *
	 * @param $body
	 * @param $discussionId
	 * @param $user
	 */
	public function __construct($body, $discussionId, $user)
	{
		$this->body = $body;
		$this->discussionId = $discussionId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 *
	 * @param DiscussionRepository $discussionRepository
	 * @param Dispatcher $event
	 */
	public function handle(DiscussionRepository $discussionRepository, Dispatcher $event)
	{
		$discussion = $discussionRepository->findById($this->discussionId);

		$comment = Comment::leaveOn($discussion, [
			'body' => $this->body,
			'user_id' => $this->user->id
		]);

		$event->fire(new CommentWasLeftOnDiscussionEvent($comment, $this->user));

	}

}
