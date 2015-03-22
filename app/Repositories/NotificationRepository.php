<?php namespace App\Repositories;


use App\Notification;

class NotificationRepository {

    /**
     * Persist a Notification
     * @param Notification $notification
     */
    public function save(Notification $notification)
    {
        $notification->save();
    }

}