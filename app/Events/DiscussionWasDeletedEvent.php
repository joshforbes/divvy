<?php namespace App\Events;

use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class DiscussionWasDeletedEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param $discussionTitle
	 * @param $taskName
	 * @param $projectId
	 * @param User $user
	 * @internal param Subtask $subtask
	 */
	public function __construct($discussionTitle, $taskName, $projectId, User $user)
	{
		$this->message = $this->createMessage($user->username, $discussionTitle, $taskName);
		$this->projectId = $projectId;
	}

	public function createMessage($username, $discussionTitle, $taskName)
	{
		return '<strong>' . htmlentities($username) . '</strong> deleted the discussion <strong>' . htmlentities($discussionTitle) . '</strong> from the task <strong>' . htmlentities($taskName) . '</strong>';
	}


}