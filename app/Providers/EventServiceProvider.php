<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'App\Events\TaskAddedToProjectEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\TaskModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		//task complete
		'App\Events\TaskWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\SubtaskAddedToTaskEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\SubtaskWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\SubtaskWasCompletedEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\SubtaskWasIncompleteEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\SubtaskWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\DiscussionStartedInTaskEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\DiscussionWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\DiscussionWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\CommentWasLeftOnDiscussionEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		'App\Events\CommentWasLeftOnSubtaskEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		],
		//delete comment
		//edit comment
		'App\Events\MemberJoinedProjectEvent' => [
			'App\Handlers\Events\LogProjectActivity'
		]
		//remove member
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
