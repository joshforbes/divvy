<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\CommentWasModifiedEvent;
use App\Http\Requests\Request;
use App\Repositories\CommentRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ModifyCommentCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 * @param Request $request
	 * @param $commentId
	 * @param $user
	 */
	public function __construct(Request $request, $commentId, $user)
	{
		$this->body = $request->body;
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
		$comment = $commentRepository->update($this->commentId, [
			'body' => $this->body
		]);

		$event->fire(new CommentWasModifiedEvent($comment, $this->user));

	}

}
