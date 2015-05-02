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
	 * @param $name
	 * @param $description
	 * @param $admin
	 */
	public function __construct($name, $description, $admin)
	{
		$this->projectName = $name;
		$this->description = $description;
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
		$project = Project::start($this->projectName, $this->description);
		$projectRepository->save($project);

		$projectRepository->addAdmin($this->admin, $project);
		$projectRepository->addUser($this->admin, $project);

		return $project;
	}

}
