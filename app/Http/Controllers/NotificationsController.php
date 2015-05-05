<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use Request;

class NotificationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param NotificationRepository $notificationRepository
	 * @param UserRepository $userRepository
	 * @param $username
	 * @return Response
	 */
	public function index(NotificationRepository $notificationRepository, UserRepository $userRepository, $username)
	{
		$user = $userRepository->findByUsernameWithNotifications($username);
		$notifications = $notificationRepository->findNotificationsForUserWithPagination($user->id, 15);

		return view('notifications.index', compact('user', 'notifications'));
	}


	/**
	 * Marks all unread notifications as read
	 *
	 * @param NotificationRepository $notificationRepository
	 * @param $username
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
	public function markAsRead(NotificationRepository $notificationRepository, $username)
	{
		$unreadNotifications = $notificationRepository->findUnreadNotificationsPlain($this->user->id);

		foreach($unreadNotifications as $notification)
		{
			$notificationRepository->markAsRead($notification);
		}

		if (Request::ajax())
		{
			return response('success', 200);
		}

		return redirect()->back();
	}

}
