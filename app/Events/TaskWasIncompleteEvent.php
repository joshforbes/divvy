<?php namespace App\Events;

use App\Events\Event;

use App\Task;
use Illuminate\Queue\SerializesModels;

class TaskWasIncompleteEvent extends Event {

	use SerializesModels;

	public $action;
	public $subject;
	public $user;
	public $project;
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
		$this->action = 'reopen_task';
		$this->subject = $task;
		$this->notifiable = $task->users;
		$this->user = $user;
		$this->task = $task;
		$this->project = $task->project;
	}

}


