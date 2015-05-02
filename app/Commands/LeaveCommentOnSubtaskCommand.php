<?php namespace App\Commands;

use App\Commands\Command;

use App\Comment;
use App\Events\CommentWasLeftOnSubtaskEvent;
use App\Http\Requests\Request;
use App\Repositories\SubtaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class LeaveCommentOnSubtaskCommand extends Command implements SelfHandling {

	protected $body;
	protected $subtaskId;
	protected $user;

	/**
	 * Create a new command instance.
	 *
	 * @param $body
	 * @param $subtaskId
	 * @param $user
	 */
	public function __construct($body, $subtaskId, $user)
	{
		$this->body = $body;
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
		$subtask = $subtaskRepository->findById($this->subtaskId);

		$comment = Comment::leaveOn($subtask, [
			'body' => $this->body,
			'user_id' => $this->user->id
		]);

		$event->fire(new CommentWasLeftOnSubtaskEvent($comment, $this->user));

	}

}
