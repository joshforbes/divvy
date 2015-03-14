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
	 * @param $taskName
	 * @param $projectId
	 */
	public function __construct($taskName, $projectId)
	{
		$this->message = $this->createMessage($taskName);
		$this->projectId = $projectId;
	}

	public function createMessage($taskName)
	{
		return 'The settings for the task "' . $taskName . '" were modified';
	}
}
