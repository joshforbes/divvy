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
        foreach ($event->notifiable as $user)
        {
            if ($user->id !== $event->userId)
            {
                $notification = Notification::notify([
                    'action'       => $event->action,
                    'read'         => false,
                    'subject_type' => get_class($event->subject),
                    'subject_id'   => $event->subject->id,
                    'project_id'   => $event->project->id,
                    'actor_id'     => $event->user->id,
                    'user_id'      => $user->id
                ]);

                $this->notificationRepository->save($notification);
            }
        }
    }

}
