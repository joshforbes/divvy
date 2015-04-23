<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskAddedToProjectEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class SubtaskAddedToTask {

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
        $subtask = $event->subject;
        $project = $event->project;
        $channel = 't'.$task->id;

        $partial = view('subtasks.partials.subtask-overview-wrapper', compact('task', 'project', 'subtask'));
        $editPartial = view('subtasks.partials.edit-subtask-modal', compact('task', 'project', 'subtask'));

        $this->pusher->trigger($channel, 'subtaskAddedToTask', [
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial
        ]);

    }

}
