<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasDeletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class ProjectWasModified {

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
        $this->dashboardHandler($event);

        $this->projectHandler($event);
    }

    /**
     * Handles events related to the dashboard
     *
     * @param $event
     * @throws \PusherException
     */
    public function dashboardHandler($event)
    {
        foreach ($event->notifiable as $user)
        {
            $channel = 'u' . $user->id;
            $project = $event->project;
            $partial = view('projects.partials.project-overview-wrapper', compact('project'));

            $this->pusher->trigger($channel, 'projectWasModified', [
                'projectId' => $project->id,
                'partial'   => (String)$partial,
                'members'   => $project->users,
                'admins'    => $project->admins
            ]);
        }
    }

    /**
     * Handles events related to the Project page
     *
     * @param $event
     * @throws \PusherException
     */
    public function projectHandler($event)
    {
        $project = $event->project;
        $channel = 'p' . $project->id;
        $partial = $project->name;


        $this->pusher->trigger($channel, 'projectWasModified', [
            'partial' => (String)$partial
        ]);
    }

}
