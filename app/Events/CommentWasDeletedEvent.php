<?php namespace App\Events;

use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class CommentWasDeletedEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param $commentableName
	 * @param $taskName
	 * @param $projectId
	 * @param User $user
	 * @internal param Subtask $subtask
	 */
	public function __construct($commentableName, $taskName, $projectId, User $user)
	{
		$this->message = $this->createMessage($user->username, $commentableName, $taskName);
		$this->projectId = $projectId;
	}

	public function createMessage($username, $commentableName, $taskName)
	{
		return '<strong>' . htmlentities($username) . '</strong> deleted a comment from <strong>' . htmlentities($commentableName) . '</strong> in the task <strong>' . htmlentities($taskName) . '</strong>';
	}


}