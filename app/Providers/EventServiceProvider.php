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
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\TaskModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\TaskWasCompletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\TaskWasIncompleteEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\TaskWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\SubtaskAddedToTaskEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\SubtaskWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\SubtaskWasCompletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\SubtaskWasIncompleteEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\SubtaskWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\DiscussionStartedInTaskEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\DiscussionWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\DiscussionWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\CommentWasLeftOnDiscussionEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\CommentWasLeftOnSubtaskEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\CommentWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\CommentWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\MemberJoinedProjectEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		],
		'App\Events\MemberRemovedFromProjectEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers'
		]
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
