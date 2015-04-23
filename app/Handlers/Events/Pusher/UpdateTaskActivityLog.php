<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasIncompleteEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class UpdateTaskActivityLog {

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
     * @return void
     */
    public function handle($event)
    {
        $task = $event->task;
        $project = $event->project;
        $channel = 't'.$task->id;
        $partial = view('activity.partials.task-activity-log', compact('task', 'project'));

        $this->pusher->trigger($channel, 'updateActivityLog', [
            'partial' => (String) $partial
        ]);
    }

}
