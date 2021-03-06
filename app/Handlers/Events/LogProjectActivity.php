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
	 * Create a log entry for any event passed in
	 *
	 * @param $event
	 */
	public function handle($event)
	{

		$activity = Activity::log([
			'action' => $event->action,
			'subject_type' => get_class($event->subject),
			'subject_id' => $event->subject->id,
			'project_id' => $event->project->id,
			'user_id' => $event->user->id,
			'task_id' => isset($event->task->id) ?
				$event->task->id : null
		]);

		$this->activityRepository->save($activity);

	}

}
