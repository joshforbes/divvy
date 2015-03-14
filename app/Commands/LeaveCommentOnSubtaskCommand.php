<?php namespace App\Commands;

use App\Commands\Command;

use App\Comment;
use App\Http\Requests\Request;
use App\Repositories\SubtaskRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class LeaveCommentOnSubtaskCommand extends Command implements SelfHandling {

	protected $body;
	protected $subtaskId;
	protected $userId;

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $subtaskId
	 * @param $userId
	 */
	public function __construct(Request $request, $subtaskId, $userId)
	{
		$this->body = $request->body;
		$this->subtaskId = $subtaskId;
		$this->userId = $userId;
	}

	/**
	 * Execute the command.
	 * @param SubtaskRepository $subtaskRepository
	 */
	public function handle(SubtaskRepository $subtaskRepository)
	{
		$subtask = $subtaskRepository->findById($this->subtaskId);

		Comment::leaveOn($subtask, [
			'body' => $this->body,
			'user_id' => $this->userId
		]);
	}

}
