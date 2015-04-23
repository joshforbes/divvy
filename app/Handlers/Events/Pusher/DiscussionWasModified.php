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
        $task = $event->task;
        $discussion = $event->subject;
        $project = $event->project;
        $channel = 't'.$task->id;
        $partial = view('discussions.partials.discussion-overview', compact('task', 'project', 'discussion'));
        $editPartial = view('discussions.partials.edit-form', compact('task', 'project', 'discussion'));

        $this->pusher->trigger($channel, 'discussionWasModified', [
            'discussionId' => $discussion->id,
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial
        ]);

    }

}
