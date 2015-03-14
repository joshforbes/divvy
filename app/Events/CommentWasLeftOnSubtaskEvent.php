<?php namespace App\Events;

use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class CommentWasLeftOnSubtaskEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param $subtask
	 * @param User $user
	 */
	public function __construct($subtask, User $user)
	{
		$this->message = $this->createMessage($user->username, $subtask->name, $subtask->task->name);
		$this->projectId = $subtask->task->project_id;
	}

	public function createMessage($username, $subtaskName, $taskName)
	{
		return $username . ' left a comment on "' . $subtaskName . '" in the task "' . $taskName . '"';
	}


}