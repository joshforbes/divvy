<?php namespace App\Http\Composers;

use App\Repositories\NotificationRepository;
use Auth;
use Illuminate\Contracts\View\View;
use JavaScript;

class NotificationDropdownComposer {

    protected $notificationRepository;

    /**
     * Create a new notification dropdown composer.
     *
     * @param NotificationRepository $notificationRepository
     * @internal param UserRepository $users
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $notifications = $this->notificationRepository->findNotificationsFor(Auth::user()->id);

        $unreadNotifications = $notifications->filter(function($notification) {
            if ($notification->read == 0) return $notification;
        });

        JavaScript::put([
            'userChannel' => 'u' . Auth::user()->id
        ]);

        $view->with('unreadNotifications', $unreadNotifications)->with('notifications', $notifications);
    }

}