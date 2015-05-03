<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasCompletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class SubtaskWasCompleted {

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
     * handles events related to the Task page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleTask($event)
    {
        $task = $event->task;
        $project = $event->project;
        $subtask = $event->subject;
        $channel = 't' . $task->id;
        $partial = view('subtasks.partials.subtask-overview-wrapper', compact('task', 'project', 'subtask'));

        $this->pusher->trigger($channel, 'subtaskWasCompleted', [
            'subtaskId' => $subtask->id,
            'partial'   => (String)$partial,
        ]);
    }

    /**
     * handles events related to the Subtask page/channel
     *
     * @param $event
     * @throws \PusherException
     */
    private function handleSubtask($event)
    {
        $task = $event->task;
        $project = $event->project;
        $subtask = $event->subject;
        $channel = 's' . $subtask->id;
        $partial = view('layouts.partials.completed-overlay');
        $headerPartial = view('subtasks.partials.header-controls', compact('task', 'project', 'subtask'));

        $this->pusher->trigger($channel, 'subtaskWasCompleted', [
            'partial'       => (String)$partial,
            'headerPartial' => (String)$headerPartial
        ]);
    }

}
