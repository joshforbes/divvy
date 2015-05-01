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
        $this->handleTask($event);

        $this->handleDiscussion($event);
    }

    /**
     * Handles events related to the Task page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleTask($event)
    {
        $task = $event->task;
        $discussion = $event->subject;
        $channel = 't' . $task->id;

        $this->pusher->trigger($channel, 'discussionWasDeleted', [
            'discussionId' => $discussion->id,
        ]);
    }

    /**
     * Handles events related to the Discussion page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleDiscussion($event)
    {
        $project = $event->project;
        $task = $event->task;
        $discussion = $event->subject;
        $channel = 'd' . $discussion->id;

        $partial = view('discussions.partials.discussion-removed', compact('project', 'task'));

        $this->pusher->trigger($channel, 'discussionWasDeleted', [
            'partial' => (String) $partial
        ]);
    }



}
