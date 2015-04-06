<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskWasIncomplete {

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
        $channel = 'p'.$project->id;
        $partial = view('tasks.partials.task-overview', compact('task', 'project'));

        $this->pusher->trigger($channel, 'taskWasIncomplete', [
            'taskId' => $task->id,
            'partial' => (String) $partial,
        ]);

    }


}
