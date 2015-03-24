<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\ProjectWasModifiedEvent;
use App\Http\Requests\Request;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class ModifyProjectCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $projectId
	 * @param $user
	 */
	public function __construct(Request $request, $projectId, $user)
	{
		$this->name = $request->name;
		$this->description = $request->description;
		$this->projectId = $projectId;
		$this->user = $user;
	}

	/**
	 * Execute the command.
	 *
	 * @param ProjectRepository $projectRepository
	 * @param Dispatcher $event
	 */
	public function handle(ProjectRepository $projectRepository, Dispatcher $event)
	{
		$project = $projectRepository->updateProject($this->projectId, [
			'name' => $this->name,
			'description' => $this->description
		]);

		$event->fire(new ProjectWasModifiedEvent($project, $this->user));

	}

}
