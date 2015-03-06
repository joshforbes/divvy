<?php namespace App\Commands;

use App\Commands\Command;

use App\Discussion;
use App\Http\Requests\Request;
use App\Repositories\DiscussionRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class StartDiscussionInTaskCommand extends Command implements SelfHandling {

    /**
     * Create a new command instance.
     *
     * @param Request $request
     * @param $taskId
     * @param $userId
     */
    public function __construct(Request $request, $taskId, $userId)
    {
        $this->title = $request->title;
        $this->body = $request->body;
		$this->taskId = $taskId;
		$this->userId = $userId;
	}

    /**
     * Execute the command.
     *
     * @param DiscussionRepository $discussionRepository
     */
    public function handle(DiscussionRepository $discussionRepository)
    {
        $discussion = Discussion::start([
            'title'   => $this->title,
            'body'    => $this->body,
            'task_id' => $this->taskId,
            'user_id' => $this->userId
        ]);

        $discussionRepository->save($discussion);
    }

}
