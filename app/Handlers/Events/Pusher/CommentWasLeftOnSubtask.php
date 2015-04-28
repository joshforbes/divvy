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
        $task = $event->task;
        $subtask = $event->subject->commentable;
        $channel = 't'.$task->id;

        $partial = view('subtasks.partials.comments-overview', compact('subtask'));

        $this->pusher->trigger($channel, 'commentWasLeftOnSubtask', [
            'partial' => (String) $partial,
            'subtaskId' => $subtask->id
        ]);

    }

}
