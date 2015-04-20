<?php namespace App\Handlers\Events\Pusher;

use App\Events\TaskWasDeletedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class ProjectWasRemoved {

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

    public function dashboardHandler($event)
    {
        foreach ($event->notifiable as $user)
        {
            $channel = 'u' . $user->id;
            $project = $event->project;

            $this->pusher->trigger($channel, 'projectWasRemoved', [
                'projectId' => $project->id,
            ]);
        }
    }

    public function projectHandler($event)
    {
        $project = $event->project;
        $channel = 'p'.$project->id;
        $partial = view('projects.partials.project-removed');


        $this->pusher->trigger($channel, 'projectWasRemoved', [
            'partial' => (String) $partial
        ]);
    }

}
