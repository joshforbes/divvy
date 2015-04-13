<?php namespace App\Events;

use App\Discussion;
use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class DiscussionStartedInTaskEvent extends Event {

	use SerializesModels;

	public $action;
	public $subject;
	public $user;
	public $project;
	public $notifiable;
	public $task;

	/**
	 * Create a new event instance.
	 *
	 * @param $discussion
	 * @param $user
	 */
	public function __construct($discussion, $user)
	{
		$this->action = 'start_discussion';
		$this->subject = $discussion;
		$this->notifiable = $discussion->task->users;
		$this->user = $user;
		$this->task = $discussion->task;
		$this->project = $discussion->task->project;
	}


}

