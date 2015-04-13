<?php namespace App\Events;

use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class SubtaskWasDeletedEvent extends Event {

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
	 * @param $subtask
	 * @param $user
	 */
	public function __construct($subtask, $user)
	{
		$this->action = 'remove_subtask';
		$this->subject = $subtask;
		$this->notifiable = $subtask->task->users;
		$this->user = $user;
		$this->task = $subtask->task;
		$this->project = $subtask->task->project;
	}
}
