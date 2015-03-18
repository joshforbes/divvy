<?php namespace App\Events;

use App\Events\Event;

use App\Task;
use App\User;
use Illuminate\Queue\SerializesModels;

class TaskWasCompletedEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param Task $task
	 */
	public function __construct(Task $task)
	{
		$this->message = $this->createMessage($task->name);
		$this->projectId = $task->project_id;
	}

	public function createMessage($taskName)
	{
		return 'A task was completed: <strong>' . htmlentities($taskName) . '</strong>';
	}


}