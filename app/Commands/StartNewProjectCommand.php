<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\Request;
use App\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class StartNewProjectCommand extends Command implements SelfHandling {

	protected $projectName;
	protected $admin;

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $admin
	 */
	public function __construct(Request $request, $admin)
	{
		$this->projectName = $request->name;
		$this->admin = $admin;
	}


	/**
	 * Execute the command
	 *
	 * @param ProjectRepository $projectRepository
	 * @return static
	 */
	public function handle(ProjectRepository $projectRepository)
	{
		$project = Project::start($this->projectName);
		$projectRepository->save($project);

		$projectRepository->addAdmin($this->admin, $project);
		$projectRepository->addUser($this->admin, $project);

		return $project;
	}

}
