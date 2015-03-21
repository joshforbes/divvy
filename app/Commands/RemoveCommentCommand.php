<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\CommentWasDeletedEvent;
use App\Repositories\CommentRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class RemoveCommentCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param $commentId
	 * @param $user
	 */
	public function __construct($commentId, $user)
	{
		$this->commentId = $commentId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 * @param CommentRepository $commentRepository
	 * @param Dispatcher $event
	 */
	public function handle(CommentRepository $commentRepository, Dispatcher $event)
	{
		$comment = $commentRepository->findById($this->commentId);


		$commentRepository->delete($comment);

		$event->fire(new CommentWasDeletedEvent($comment, $this->user));
	}

}