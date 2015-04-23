<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskModifiedEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class SubtaskWasModified {

    private $pusher;

    /**
     * Create the event handler.
     * @param ProjectRepository $projectRepository
     * @param Pusher $pusher
     */
    public function __construct(ProjectRepository $projectRepository, Pusher $pusher)
    {
        $this->pusher = $pusher;
        $this->projectRepository = $projectRepository;
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
        $editPartial = view('subtasks.partials.edit-form', compact('task', 'project', 'subtask'));

        $this->pusher->trigger($channel, 'subtaskWasModified', [
            'subtaskId' => $subtask->id,
            'partial' => (String) $partial,
            'editPartial' => (String) $editPartial
        ]);

    }

}
