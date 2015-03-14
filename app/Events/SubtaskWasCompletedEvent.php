<?php namespace App\Events;

use App\Events\Event;

use App\Subtask;
use App\User;
use Illuminate\Queue\SerializesModels;

class SubtaskWasCompletedEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param Subtask $subtask
	 * @param User $user
	 */
	public function __construct(Subtask $subtask, User $user)
	{
		$this->message = $this->createMessage($user->username, $subtask->name, $subtask->task->name);
		$this->projectId = $subtask->task->project_id;
	}

	public function createMessage($username, $subtaskName, $taskName)
	{
		return '<strong>' . htmlentities($username) . '</strong> completed the subtask <strong>' . htmlentities($subtaskName) . '</strong> from the task <strong>' . htmlentities($taskName) . '</strong>';
	}


}
