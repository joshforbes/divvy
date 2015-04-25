<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class SubtaskWasIncomplete {

    /**
     * @var Pusher
     */
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
        $task = $event->task;
        $project = $event->project;
        $subtask = $event->subject;
        $channel = 't'.$task->id;
        $partial = view('subtasks.partials.subtask-overview-wrapper', compact('task', 'project', 'subtask'));

        $this->pusher->trigger($channel, 'subtaskWasIncomplete', [
            'subtaskId' => $subtask->id,
            'partial' => (String) $partial,
        ]);

    }


}
