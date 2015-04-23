<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasDeletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class DiscussionWasDeleted {

    private $pusher;

    /**
     * Create the event handler.
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
        $discussion = $event->subject;
        $channel = 't'.$task->id;

        $this->pusher->trigger($channel, 'discussionWasDeleted', [
            'discussionId' => $discussion->id,
        ]);

    }

}
