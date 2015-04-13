<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class ProjectWasModifiedEvent extends Event {

	use SerializesModels;

	public $action;
	public $subject;
	public $user;
	public $project;
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
		$this->subject = $project;
		$this->notifiable = $project->users;
		$this->project = $project;
		$this->user = $currentUser;
	}


}
