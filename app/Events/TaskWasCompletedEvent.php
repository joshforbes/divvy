<?php namespace App\Events;

use App\Events\Event;

use App\Task;
use App\User;
use Illuminate\Queue\SerializesModels;

class TaskWasCompletedEvent extends Event {

	use SerializesModels;

	public $action;
	public $subjectId;
	public $subjectType;
	public $userId;
	public $projectId;
	public $notifiable;
	public $task;

	/**
	 * Create a new event instance.
	 *
	 * @param $task
	 * @param $user
	 */
	public function __construct($task, $user)
	{
		$this->action = 'complete_task';
		$this->subjectId = $task->id;
		$this->subjectType = get_class($task);
		$this->userId = $user->id;
		$this->projectId = $task->project_id;
		$this->notifiable = $task->users;
		$this->task = $task;
	}
}