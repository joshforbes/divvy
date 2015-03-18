<?php namespace App\Events;

use App\Comment;
use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class CommentWasModifiedEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param Comment $comment
	 * @param User $user
	 */
	public function __construct(Comment $comment, User $user)
	{
		$this->message = $this->createMessage($user->username, $this->commentableName($comment), $comment->commentable->task->name);
		$this->projectId = $comment->commentable->task->project_id;
	}

	public function createMessage($username, $commentableName, $taskName)
	{
		return '<strong>' . htmlentities($username) . '</strong> modified a comment from <strong>' . htmlentities($commentableName) . '</strong> in the task <strong>' . htmlentities($taskName) . '</strong>';
	}

	public function commentableName($comment)
	{
		return $comment->commentable->title ? $comment->commentable->title : $comment->commentable->name;
	}
}