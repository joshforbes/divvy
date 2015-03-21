<?php namespace App\Events;

use App\Discussion;
use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class DiscussionWasModifiedEvent extends Event {


	use SerializesModels;

	public $action;
	public $subjectId;
	public $subjectType;
	public $userId;
	public $projectId;

	/**
	 * Create a new event instance.
	 *
	 * @param $discussion
	 * @param $user
	 */
	public function __construct($discussion, $user)
	{
		$this->action = 'modify_discussion';
		$this->subjectId = $discussion->id;
		$this->subjectType = get_class($discussion);
		$this->userId = $user->id;
		$this->projectId = $discussion->task->project_id;
	}


}