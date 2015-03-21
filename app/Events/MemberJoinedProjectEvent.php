<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class MemberJoinedProjectEvent extends Event {


	use SerializesModels;

	public $action;
	public $subjectId;
	public $subjectType;
	public $userId;
	public $projectId;

	/**
	 * Create a new event instance.
	 *
	 * @param $user
	 * @param $project
	 */
	public function __construct($user, $project)
	{
		$this->action = 'add_member';
		$this->subjectId = $user->id;
		$this->subjectType = get_class($user);
		$this->userId = $user->id;
		$this->projectId = $project->id;
	}


}