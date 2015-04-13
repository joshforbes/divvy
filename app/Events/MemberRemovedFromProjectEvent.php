<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class MemberRemovedFromProjectEvent extends Event {


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
		$this->action = 'remove_member';
		$this->subject = $user;
		$this->notifiable = [$user];
		$this->project = $project;
		$this->user = $currentUser;
	}


}