<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasIncompleteEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskCompletionChanged {

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
        $channel = 't'.$task->id;
        $partial = view('tasks.partials.task-progress', compact('task'));

        $this->pusher->trigger($channel, 'taskCompletionChanged', [
            'partial' => (String) $partial
        ]);
    }

}
