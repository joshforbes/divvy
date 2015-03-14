<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class TaskModifiedEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 *
	 * @param $task
	 */
	public function __construct($task)
	{
		$this->message = $this->createMessage($task->name);
		$this->projectId = $task->project_id;
	}

	public function createMessage($taskName)
	{
		return 'The settings for the task <strong>' . htmlentities($taskName) . '</strong> were modified';
	}
}
