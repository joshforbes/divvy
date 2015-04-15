<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use App\Repositories\NotificationRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class NotifyUsers {

	/**
	 * @var Pusher
	 */
	private $pusher;

	/**
	 * Create the event handler.
	 * @param Pusher $pusher
	 */
	public function __construct(Pusher $pusher, NotificationRepository $notificationRepository)
	{
		$this->pusher = $pusher;
		$this->notificationRepository = $notificationRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param $event
	 * @return void
	 */
	public function handle($event)
	{
		foreach ($event->notifiable as $user)
		{
			if ($user->id !== $event->user->id)
			{
				$channel = 'u'.$user->id;
				$notification = $this->notificationRepository->findNewestNotification($user->id);
				$unreadNotifications = $this->notificationRepository->findUnreadNotificationsPlain($user->id);

				$notificationPartial = view('notifications.dropdown-notification', compact('notification'));
				$notificationCountPartial = view('notifications.count', compact('unreadNotifications'));

				$this->pusher->trigger($channel, 'notifyUsers', [
					'notificationPartial' => (String) $notificationPartial,
					'notificationCountPartial' => (String) $notificationCountPartial
				]);
			}
		}
	}

}

