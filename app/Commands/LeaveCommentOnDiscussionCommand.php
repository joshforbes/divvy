<?php namespace App\Commands;

use App\Commands\Command;

use App\Comment;
use App\Http\Requests\Request;
use App\Repositories\DiscussionRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class LeaveCommentOnDiscussionCommand extends Command implements SelfHandling {

	protected $body;
	protected $discussionId;
	protected $userId;

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $discussionId
	 * @param $userId
	 */
	public function __construct(Request $request, $discussionId, $userId)
	{
		$this->body = $request->body;
		$this->discussionId = $discussionId;
		$this->userId = $userId;
	}

	/**
	 * Execute the command.
	 *
	 * @param DiscussionRepository $discussionRepository
	 */
	public function handle(DiscussionRepository $discussionRepository)
	{
		$discussion = $discussionRepository->findById($this->discussionId);

		Comment::leaveOn($discussion, [
			'body' => $this->body,
			'user_id' => $this->userId
		]);
	}

}
