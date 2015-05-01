<?php namespace App\Handlers\Events\Pusher;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class CommentWasModified {

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

    /**
     * handles events for the discussion page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleDiscussion($event)
    {
        $task = $event->task;
        $discussion = $event->subject->commentable;
        $comment = $event->subject;
        $project = $event->project;
        $channel = 'd'.$discussion->id;

        $partial = view('comments.partials.comment', compact('task', 'project', 'comment'));
        $editPartial = view('comments.partials.edit-comment-modal', compact('task', 'project', 'comment'));

        $this->pusher->trigger($channel, 'commentWasModified', [
            'commentId' => $comment->id,
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial
        ]);

    }

    /**
     * handles events for the subtask page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleSubtask($event)
    {
        $task = $event->task;
        $subtask = $event->subject->commentable;
        $comment = $event->subject;
        $project = $event->project;
        $channel = 's'.$subtask->id;

        $partial = view('comments.partials.comment', compact('task', 'project', 'comment'));
        $editPartial = view('comments.partials.edit-comment-modal', compact('task', 'project', 'comment'));

        $this->pusher->trigger($channel, 'commentWasModified', [
            'commentId' => $comment->id,
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial
        ]);
    }
}
