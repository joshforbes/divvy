<?php namespace App\Handlers\Events;

use App\Commands\AddSubtaskToTaskCommand;
use App\Commands\AddTaskToProjectCommand;
use App\Commands\StartDiscussionInTaskCommand;
use App\Commands\StartNewProjectCommand;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class BootstrapNewUser {

	/**
	 * Create the event handler.
	 * @param Dispatcher $dispatcher
	 * @param Guard $auth
	 */
	public function __construct(Dispatcher $dispatcher, Guard $auth)
	{
		$this->dispatcher = $dispatcher;
		$this->auth = $auth;
	}

	/**
	 * Handle the event.
	 *
	 * @param $event
	 */
	public function handle($event)
	{
		$this->auth->login($event->user);

		$project = $this->dispatcher->dispatch(
			new StartNewProjectCommand(
				'Example Project',
				'Here is an example project',
				$event->user
			)
		);

		$task = $this->dispatcher->dispatch(
			new AddTaskToProjectCommand(
				'name',
				'description',
				[0 => $event->user->id],
				$project->id,
				$event->user
			)
		);

		$this->dispatcher->dispatch(
			new AddSubtaskToTaskCommand(
				'name',
				$task->id,
				$event->user
			)
		);

		$this->dispatcher->dispatch(
			new StartDiscussionInTaskCommand(
				'title',
				'body',
				$task->id,
				$event->user
			)
		);
	}

}
