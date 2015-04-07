<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class TaskModifiedEvent extends Event {

	use SerializesModels;

	public $action;
	public $subjectId;
	public $subjectType;
	public $userId;
	public $projectId;
	public $notifiable;
	public $task;
	public $project;

	/**
	 * Create a new event instance.
	 *
	 * @param $task
	 * @param $user
	 */
	public function __construct($task, $user)
	{
		$this->action = 'modify_task';
		$this->subjectId = $task->id;
		$this->subjectType = get_class($task);
		$this->userId = $user->id;
		$this->projectId = $task->project_id;
		$this->notifiable = $task->users;
		$this->task = $task;
		$this->project = $task->project;
	}

}
