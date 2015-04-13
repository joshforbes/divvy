<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class MemberJoinedProjectEvent extends Event {

	use SerializesModels;

	public $action;
	public $subject;
	public $user;
	public $project;
	public $notifiable;


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
		$this->subject = $user;
		$this->notifiable = [$user];
		$this->project = $project;
		$this->user = $currentUser;
	}


}