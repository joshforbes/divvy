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
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskAddedToProject',
			'App\Handlers\Events\Pusher\ProjectCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\TaskModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskModified',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\TaskWasCompletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskWasCompleted',
			'App\Handlers\Events\Pusher\ProjectCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\TaskWasIncompleteEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskWasIncomplete',
			'App\Handlers\Events\Pusher\ProjectCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\TaskWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskWasDeleted',
			'App\Handlers\Events\Pusher\ProjectCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\SubtaskAddedToTaskEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskModified',
			'App\Handlers\Events\Pusher\TaskCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\SubtaskAddedToTask',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\SubtaskWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskModified',
			'App\Handlers\Events\Pusher\TaskCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\SubtaskWasDeleted',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\SubtaskWasCompletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\SubtaskWasCompleted',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\SubtaskWasIncompleteEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskCompletionChanged',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\SubtaskWasIncomplete',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\SubtaskWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\SubtaskWasModified',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\DiscussionStartedInTaskEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskModified',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\DiscussionStartedInTask',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\DiscussionWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\TaskModified',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\DiscussionWasDeleted',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\DiscussionWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\DiscussionWasModified',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\CommentWasLeftOnDiscussionEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\CommentWasLeftOnDiscussion',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\CommentWasLeftOnSubtaskEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\CommentWasLeftOnSubtask',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\CommentWasDeletedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\CommentWasDeleted',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\CommentWasModifiedEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\UpdateTaskActivityLog',
			'App\Handlers\Events\Pusher\CommentWasModified',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\MemberJoinedProjectEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\MemberJoinedProject',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\ProjectWasModified',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\MemberRemovedFromProjectEvent' => [
			'App\Handlers\Events\LogProjectActivity',
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\MemberRemovedFromProject',
			'App\Handlers\Events\Pusher\UpdateActivityLog',
			'App\Handlers\Events\Pusher\ProjectWasModified',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\ProjectWasRemovedEvent' => [
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\ProjectWasRemoved',
			'App\Handlers\Events\Pusher\NotifyUsers'
		],
		'App\Events\ProjectWasModifiedEvent' => [
			'App\Handlers\Events\NotifyUsers',
			'App\Handlers\Events\Pusher\ProjectWasModified',
			'App\Handlers\Events\Pusher\NotifyUsers'
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
