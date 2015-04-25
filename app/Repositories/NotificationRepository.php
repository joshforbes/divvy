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

    /**
     * Find unread notifications by user id. Eager load relationships
     *
     * @param $userId
     * @return mixed
     */
    public function findUnreadNotificationsFor($userId)
    {
        return Notification::with('user', 'project', 'actor.profile', 'subject.commentable')->where('user_id', $userId)->where('read', 0)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Find notifications by user id without eager loading relationships
     *
     * @param $userId
     * @return mixed
     */
    public function findUnreadNotificationsPlain($userId)
    {
        return Notification::where('user_id', $userId)->where('read', 0)->orderBy('created_at', 'DESC')->get();
    }

    public function findNewestNotification($userId)
    {
        return Notification::where('user_id', $userId)->where('read', 0)->orderBy('created_at', 'DESC')->firstOrFail();
    }

    /**
     * Find notifications by id. Eager load relationships
     *
     * @param $userId
     * @return mixed
     */
    public function findNotificationsFor($userId)
    {
        return Notification::with('user', 'project', 'actor.profile', 'subject.commentable')->where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Find notifications by id. Eager load relationships. Paginate
     *
     * @param $userId
     * @return mixed
     */
    public function findNotificationsForUserWithPagination($userId, $numberPerPage)
    {
        return Notification::with('user', 'project', 'actor.profile', 'subject.commentable')->where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate($numberPerPage);
    }

    /**
     * Mark the specified notification as read
     *
     * @param Notification $notification
     * @return mixed
     */
    public function markAsRead(Notification $notification)
    {
        $notification->read = 1;
        $notification->save();
        return $notification;
    }


}