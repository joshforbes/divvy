<?php namespace App\Events;

use App\Discussion;
use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class DiscussionStartedInTaskEvent extends Event {

	use SerializesModels;

	public $message;
	public $projectId;

	/**
	 * Create a new event instance.
	 * @param Discussion $discussion
	 * @param User $user
	 */
	public function __construct(Discussion $discussion, User $user)
	{
		$this->message = $this->createMessage($user->username, $discussion->title, $discussion->task->name);
		$this->projectId = $discussion->task->project_id;
	}

	public function createMessage($username, $discussionTitle, $taskName)
	{
		return $username . ' posted a new message "' . $discussionTitle . '" in the task "' . $taskName . '"';
	}


}

