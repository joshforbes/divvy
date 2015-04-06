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
	public $notifiable;
	public $project;

	/**
	 * Create a new event instance.
	 *
	 * @param $user
	 * @param $project
	 * @param $currentUser
	 */
	public function __construct($user, $project, $currentUser)
	{
		$this->action = 'add_member';
		$this->subjectId = $user->id;
		$this->subjectType = get_class($user);
		$this->userId = $currentUser->id;
		$this->projectId = $project->id;
		$this->notifiable = [$user];
		$this->project = $project;
	}


}