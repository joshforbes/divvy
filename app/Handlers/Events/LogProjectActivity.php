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
	public function handle($event)
	{
		$activity = Activity::log([
			'action' => $event->action,
			'subject_type' => $event->subjectType,
			'subject_id' => $event->subjectId,
			'project_id' => $event->projectId,
			'user_id' => $event->userId
		]);

		$this->activityRepository->save($activity);

	}

}
