<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class ProjectWasModifiedEvent extends Event {

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
	 * @param $project
	 * @param $currentUser
	 */
	public function __construct($project, $currentUser)
	{
		$this->action = 'modify_project';
		$this->subjectId = $project->id;
		$this->subjectType = get_class($project);
		$this->userId = $currentUser->id;
		$this->projectId = $project->id;
		$this->notifiable = $project->users;
	}


}
