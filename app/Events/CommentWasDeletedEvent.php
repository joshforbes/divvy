<?php namespace App\Events;

use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class CommentWasDeletedEvent extends Event {

	use SerializesModels;

	public $action;
	public $subjectId;
	public $subjectType;
	public $userId;
	public $projectId;

	/**
	 * Create a new event instance.
	 *
	 * @param $comment
	 * @param $user
	 */
	public function __construct($comment, $user)
	{
		$this->action = 'remove_comment';
		$this->subjectId = $comment->id;
		$this->subjectType = get_class($comment);
		$this->userId = $user->id;
		$this->projectId = $comment->commentable->task->project_id;
	}


}