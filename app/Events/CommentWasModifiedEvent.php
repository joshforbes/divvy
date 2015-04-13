<?php namespace App\Events;

use App\Comment;
use App\Events\Event;

use App\User;
use Illuminate\Queue\SerializesModels;

class CommentWasModifiedEvent extends Event {

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
	 * @param $comment
	 * @param $user
	 */
	public function __construct($comment, $user)
	{
		$this->action = 'modify_comment';
		$this->subject = $comment;
		$this->notifiable = $comment->commentable->task->users;
		$this->user = $user;
		$this->task = $comment->commentable->task;
		$this->project = $comment->commentable->task->project;
	}


}