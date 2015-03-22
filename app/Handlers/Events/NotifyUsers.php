<?php namespace App\Handlers\Events;

use App\Events\TaskAddedToProjectEvent;

use App\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class NotifyUsers {

	/**
	 * Create the event handler.
	 *
	 * @param NotificationRepository $notificationRepository
	 */
	public function __construct(NotificationRepository $notificationRepository)
	{
		$this->notificationRepository = $notificationRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param $event
	 */
	public function handle($event)
	{
		foreach($event->notifiable as $user)
		{
			$notification = Notification::notify([
				'action' => $event->action,
				'read' => false,
				'subject_type' => $event->subjectType,
				'subject_id' => $event->subjectId,
				'project_id' => $event->projectId,
				'actor_id' => $event->userId,
				'user_id' => $user->id
			]);

			$this->notificationRepository->save($notification);
		}
	}

}
