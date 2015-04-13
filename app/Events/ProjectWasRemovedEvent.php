<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class ProjectWasRemovedEvent extends Event {

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
		$this->action = 'remove_project';
		$this->subject = $project;
		$this->notifiable = $project->users;
		$this->user = $currentUser;
		$this->project = $project;
	}


}
