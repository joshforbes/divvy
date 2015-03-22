<?php namespace App\Events;

use App\Events\Event;

use App\Subtask;
use App\User;
use Illuminate\Queue\SerializesModels;

class SubtaskWasModifiedEvent extends Event {


	use SerializesModels;

	public $action;
	public $subjectId;
	public $subjectType;
	public $userId;
	public $projectId;
	public $notifiable;

	/**
	 * Create a new event instance.
	 *
	 * @param $subtask
	 * @param $user
	 */
	public function __construct($subtask, $user)
	{
		$this->action = 'modify_subtask';
		$this->subjectId = $subtask->id;
		$this->subjectType = get_class($subtask);
		$this->userId = $user->id;
		$this->projectId = $subtask->task->project_id;
		$this->notifiable = $subtask->task->users;
	}

}