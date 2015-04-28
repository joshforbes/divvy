<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class CommentWasDeleted {

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
        $commentable = (new \ReflectionClass($event->subject->commentable))->getShortName();

        if ($commentable === 'Discussion')
        {
            $this->handleDiscussion($event);
        }

        if ($commentable === 'Subtask')
        {
            $this->handleSubtask($event);
        }

    }

    private function handleDiscussion($event)
    {
        $task = $event->task;
        $discussion = $event->subject->commentable;
        $channel = 't'.$task->id;

        $partial = view('discussions.partials.comments-overview', compact('discussion'));

        $this->pusher->trigger($channel, 'commentWasDeletedOnDiscussion', [
            'partial' => (String) $partial,
            'discussionId' => $discussion->id
        ]);
    }

    private function handleSubtask($event)
    {
        $task = $event->task;
        $subtask = $event->subject->commentable;
        $channel = 't'.$task->id;

        $partial = view('subtasks.partials.comments-overview', compact('subtask'));

        $this->pusher->trigger($channel, 'commentWasDeletedOnSubtask', [
            'partial' => (String) $partial,
            'subtaskId' => $subtask->id
        ]);
    }
}
