<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\ProjectWasRemovedEvent;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;

class RemoveProjectCommand extends Command implements SelfHandling {

	/**
	 * Create a new command instance.
	 *
	 * @param $projectId
	 * @param $currentUser
	 */
	public function __construct($projectId, $currentUser)
	{
		$this->projectId = $projectId;
		$this->currentUser = $currentUser;
	}

	/**
	 * Execute the command.
	 *
	 * @param ProjectRepository $projectRepository
	 * @param Dispatcher $event
	 */
	public function handle(ProjectRepository $projectRepository, Dispatcher $event)
	{
		$project = $projectRepository->findById($this->projectId);

		$projectRepository->delete($project);

		$event->fire(new ProjectWasRemovedEvent($project, $this->currentUser));


	}

}
