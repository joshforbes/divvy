<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class CommentWasLeftOnSubtask {

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

        $this->handleSubtask($event);
    }

    /**
     * handle events related to the Task page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleTask($event)
    {
        $task = $event->task;
        $subtask = $event->subject->commentable;
        $channel = 't'.$task->id;

        $partial = view('subtasks.partials.comments-overview', compact('subtask'));

        $this->pusher->trigger($channel, 'commentWasLeftOnSubtask', [
            'partial' => (String) $partial,
            'subtaskId' => $subtask->id
        ]);
    }


    /**
     * handle events related to the Subtask page/channel
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

        $partial = view('comments.partials.comment', compact('task', 'project', 'subtask', 'comment'));
        $editPartial = view('comments.partials.edit-comment-modal', compact('task', 'project', 'subtask', 'comment'));

        $this->pusher->trigger($channel, 'commentWasLeft', [
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial
        ]);
    }

}
