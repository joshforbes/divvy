<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class DiscussionStartedInTask {

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
        $discussion = $event->subject;
        $project = $event->project;
        $channel = 't'.$task->id;

        $partial = view('discussions.partials.discussion-overview', compact('task', 'project', 'discussion'));
        $editPartial = view('discussions.partials.edit-discussion-modal', compact('task', 'project', 'discussion'));

        $this->pusher->trigger($channel, 'discussionStartedInTask', [
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial
        ]);

    }

}
