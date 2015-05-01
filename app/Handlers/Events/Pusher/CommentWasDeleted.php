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
            $this->handleTaskDiscussion($event);
            $this->handleDiscussion($event);
        }

        if ($commentable === 'Subtask')
        {
            $this->handleTaskSubtask($event);
            $this->handleSubtask($event);
        }

    }

    /**
     * handles events for the task page if the deleted comment is
     * from a discussion
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleTaskDiscussion($event)
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

    /**
     * handles events for the discussion page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleDiscussion($event)
    {
        $comment = $event->subject;
        $discussion = $event->subject->commentable;
        $channel = 'd'.$discussion->id;

        $this->pusher->trigger($channel, 'commentWasDeleted', [
            'commentId' => $comment->id
        ]);
    }

    /**
     * handles events for the task page if the deleted comment is
     * from a subtask
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleTaskSubtask($event)
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

    /**
     * handles events for the subtask page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleSubtask($event)
    {
        $comment = $event->subject;
        $subtask = $event->subject->commentable;
        $channel = 's'.$subtask->id;

        $this->pusher->trigger($channel, 'commentWasDeleted', [
            'commentId' => $comment->id
        ]);
    }
}
