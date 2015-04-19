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

        foreach ($event->notifiable as $user)
        {
            $channel = 'u' . $user->id;
            $project = $event->project;

            $this->pusher->trigger($channel, 'projectWasRemoved', [
                'projectId' => $project->id,
            ]);
        }

    }

}
