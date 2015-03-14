<?php namespace App\Events;

use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class SubtaskWasDeletedEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param $subtaskName
	 * @param $taskName
	 * @param $projectId
	 * @param User $user
	 * @internal param Subtask $subtask
	 */
	public function __construct($subtaskName, $taskName, $projectId, User $user)
	{
		$this->message = $this->createMessage($user->username, $subtaskName, $taskName);
		$this->projectId = $projectId;
	}

	public function createMessage($username, $subtaskName, $taskName)
	{
		return '<strong>' . htmlentities($username) . '</strong> deleted the subtask <strong>' . htmlentities($subtaskName) . '</strong> from the task <strong>' . htmlentities($taskName) . '</strong>';
	}


}
