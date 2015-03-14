<?php namespace App\Commands;

use App\Commands\Command;

use App\Events\MemberJoinedProjectEvent;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;

class AddMemberToProjectCommand extends Command implements SelfHandling {

	protected $userEmail;
	protected $projectId;

	/**
	 * Create a new command instance.
	 *
	 * @param Request $request
	 * @param $projectId
	 */
	public function __construct(Request $request, $projectId)
	{
		$this->userEmail = $request->input('user');
		$this->projectId = $projectId;
	}

	/**
	 * Execute the command.
	 *
	 * @param ProjectRepository $projectRepository
	 * @param UserRepository $userRepository
	 * @param Dispatcher $event
	 * @return mixed
	 */
	public function handle(ProjectRepository $projectRepository, UserRepository $userRepository, Dispatcher $event)
	{
		$project = $projectRepository->findById($this->projectId);

		$user = $userRepository->findByEmail($this->userEmail);

		if (!$user)
		{
			dd('invite email');
		}

		$projectRepository->addUser($user, $project);

		$event->fire(new MemberJoinedProjectEvent($user, $project));

		return $project;
	}

}
