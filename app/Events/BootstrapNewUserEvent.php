<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class BootstrapNewUserEvent extends Event {

	use SerializesModels;

	public $user;

	/**
	 * Create a new event instance.
	 *
	 * @param $user
	 */
	public function __construct($user)
	{
		$this->user = $user;
	}

}
