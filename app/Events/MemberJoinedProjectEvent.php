<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class MemberJoinedProjectEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 *
	 * @param $user
	 * @param $project
	 */
	public function __construct($user, $project)
	{
		$this->message = $this->createMessage($user->username);
		$this->projectId = $project->id;
	}

	public function createMessage($username)
	{
		return '<strong>' . htmlentities($username) . '</strong> has joined the project';
	}


}