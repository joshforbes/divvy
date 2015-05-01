<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasDeletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class SubtaskWasDeleted {

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
        $this->handleSubtask($event);
    }

    /**
     * Handles events related to the Task page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleTask($event) {
        $task = $event->task;
        $subtask = $event->subject;
        $channel = 't'.$task->id;

        $this->pusher->trigger($channel, 'subtaskWasDeleted', [
            'subtaskId' => $subtask->id,
        ]);
    }


    /**
     * Handles events related to the Subtask page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleSubtask($event)
    {
        $project = $event->project;
        $task = $event->task;
        $subtask = $event->subject;
        $channel = 's' . $subtask->id;

        $partial = view('subtasks.partials.subtask-removed', compact('project', 'task'));

        $this->pusher->trigger($channel, 'subtaskWasDeleted', [
            'partial' => (String) $partial
        ]);
    }

}
