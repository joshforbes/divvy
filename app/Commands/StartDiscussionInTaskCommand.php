<?php namespace App\Commands;

use App\Commands\Command;

use App\Discussion;
use App\Events\DiscussionStartedInTaskEvent;
use App\Http\Requests\Request;
use App\Repositories\DiscussionRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class StartDiscussionInTaskCommand extends Command implements SelfHandling {

    /**
     * Create a new command instance.
     *
     * @param Request $request
     * @param $taskId
     * @param $userId
     */
    public function __construct(Request $request, $taskId, $user)
    {
        $this->title = $request->title;
        $this->body = $request->body;
		$this->taskId = $taskId;
        $this->user = $user;
	}

    /**
     * Execute the command.
     *
     * @param DiscussionRepository $discussionRepository
     * @param Dispatcher $event
     */
    public function handle(DiscussionRepository $discussionRepository, Dispatcher $event)
    {
        $discussion = Discussion::start([
            'title'   => $this->title,
            'body'    => $this->body,
            'task_id' => $this->taskId,
            'user_id' => $this->user->id
        ]);

        $discussionRepository->save($discussion);

        $event->fire(new DiscussionStartedInTaskEvent($discussion, $this->user));

    }

}
