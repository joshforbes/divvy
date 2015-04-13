<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class TaskModifiedEvent extends Event {

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
		$this->action = 'modify_task';
		$this->subject = $task;
		$this->notifiable = $task->users;
		$this->user = $user;
		$this->task = $task;
		$this->project = $task->project;
	}

}
