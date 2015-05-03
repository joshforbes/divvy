<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskModifiedEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class DiscussionWasModified {

    private $pusher;

    /**
     * Create the event handler.
     * @param ProjectRepository $projectRepository
     * @param Pusher $pusher
     */
    public function __construct(ProjectRepository $projectRepository, Pusher $pusher)
    {
        $this->pusher = $pusher;
        $this->projectRepository = $projectRepository;
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
     * Handles events related to the task page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleTask($event)
    {
        $task = $event->task;
        $discussion = $event->subject;
        $project = $event->project;
        $channel = 't' . $task->id;
        $partial = view('discussions.partials.discussion-overview', compact('task', 'project', 'discussion'));
        $editPartial = view('discussions.partials.edit-form', compact('task', 'project', 'discussion'));

        $this->pusher->trigger($channel, 'discussionWasModified', [
            'discussionId' => $discussion->id,
            'partial'      => (String)$partial,
            'editPartial'  => (String)$editPartial,
            'author'       => $discussion->author
        ]);
    }

    /**
     * Handles events related to the discussion page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleDiscussion($event)
    {
        $task = $event->task;
        $discussion = $event->subject;
        $project = $event->project;
        $channel = 'd' . $discussion->id;
        $partial = view('discussions.partials.discussion', compact('task', 'project', 'discussion'));
        $editPartial = view('discussions.partials.edit-form', compact('task', 'project', 'discussion'));

        $this->pusher->trigger($channel, 'discussionWasModified', [
            'discussionId' => $discussion->id,
            'partial'      => (String)$partial,
            'editPartial'  => (String)$editPartial,
            'author'       => $discussion->author
        ]);

    }

}
