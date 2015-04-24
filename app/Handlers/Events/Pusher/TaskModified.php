<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskModifiedEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class TaskModified {

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
        $this->projectHandler($event);
        $this->taskHandler($event);
    }

    /**
     * Handles events related to the projects page
     * @param $event
     * @throws \PusherException
     */
    protected function projectHandler($event)
    {
        $task = $event->task;
        $project = $event->project;
        $channel = 'p' . $project->id;
        $members = $this->projectRepository->usersInProjectArray($project);
        $partial = view('tasks.partials.task-overview-wrapper', compact('task', 'project', 'members'));

        $this->pusher->trigger($channel, 'taskModified', [
            'taskId'  => $task->id,
            'partial' => (String)$partial,
            'members' => $task->users
        ]);
    }

    /**
     * Handles events related to the task page
     * @param $event
     * @throws \PusherException
     */
    protected function taskHandler($event)
    {
        $project = $event->project;
        $task = $event->task;
        $channel = 't' . $task->id;
        $members = $task->users;
        $partial = view('users.partials.task-members-body', compact('project', 'task'));
        $removedPartial = view('tasks.partials.task-user-removed', compact('project'));
        $taskName = $task->name;

        $this->pusher->trigger($channel, 'taskModified', [
            'partial' => (String) $partial,
            'removedPartial' => (String) $removedPartial,
            'taskName' => $taskName,
            'members' => $members,
        ]);

    }

}
