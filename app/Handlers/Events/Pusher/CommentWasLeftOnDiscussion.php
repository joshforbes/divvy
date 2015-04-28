<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class CommentWasLeftOnDiscussion {

    private $pusher;

    /**
     * Create the event handler.
     *
     * @param Pusher $pusher
     */
    public function __construct(Pusher $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event)
    {
        $task = $event->task;
        $discussion = $event->subject->commentable;
        $channel = 't'.$task->id;

        $partial = view('discussions.partials.comments-overview', compact('discussion'));

        $this->pusher->trigger($channel, 'commentWasLeftOnDiscussion', [
            'partial' => (String) $partial,
            'discussionId' => $discussion->id
        ]);

    }

}
