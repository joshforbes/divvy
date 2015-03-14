<?php namespace App\Handlers\Events;

use App\Activity;
use App\Events\TaskAddedToProjectEvent;

use App\Repositories\ActivityRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class LogProjectActivity {

	/**
	 * Create the event handler.
	 * @param ActivityRepository $activityRepository
	 */
	public function __construct(ActivityRepository $activityRepository)
	{
		$this->activityRepository = $activityRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param  TaskAddedToProjectEvent $event
	 */
	public function handle(TaskAddedToProjectEvent $event)
	{
		$activity = Activity::log([
			'body' => $event->message,
			'project_id' => $event->projectId
		]);

		$this->activityRepository->save($activity);

	}

}
