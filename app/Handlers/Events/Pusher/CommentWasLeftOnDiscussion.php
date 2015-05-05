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
        $this->handleTask($event);

        $this->handleDiscussion($event);
    }

    /**
     * handle events related to the Task page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    public function handleTask($event)
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

    /**
     * handle events related to the Discussion page/channel
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

        $partial = view('comments.partials.comment', compact('task', 'project', 'subtask', 'comment'));
        $editPartial = view('comments.partials.edit-comment-modal', compact('task', 'project', 'discussion', 'comment'));

        $this->pusher->trigger($channel, 'commentWasLeft', [
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial,
            'author' => $comment->author
        ]);
    }

}
