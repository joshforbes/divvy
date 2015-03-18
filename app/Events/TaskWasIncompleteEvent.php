<?php namespace App\Events;

use App\Events\Event;

use App\Task;
use Illuminate\Queue\SerializesModels;

class TaskWasIncompleteEvent extends Event {

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
		return 'A task was re-opened: <strong>' . htmlentities($taskName) . '</strong>';
	}

}


