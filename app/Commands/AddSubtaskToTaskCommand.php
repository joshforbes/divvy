<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\SubtaskAddedToTaskEvent;
use App\Http\Requests\Request;
use App\Repositories\SubtaskRepository;
use App\Subtask;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class AddSubtaskToTaskCommand extends Command implements SelfHandling {

    /**
     * Create a new command instance.
     *
     * @param Request $request
     * @param $taskId
     */
    public function __construct(Request $request, $taskId, $user)
    {
        $this->name = $request->name;
        $this->taskId = $taskId;
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @param SubtaskRepository $subtaskRepository
     * @param Dispatcher $event
     */
    public function handle(SubtaskRepository $subtaskRepository, Dispatcher $event)
    {
        $subtask = Subtask::add([
            'name'        => $this->name,
            'isCompleted' => 0,
            'task_id'     => $this->taskId,
        ]);

        $subtaskRepository->save($subtask);

        $event->fire(new SubtaskAddedToTaskEvent($subtask, $this->user));
    }

}
