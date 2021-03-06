<?php namespace App\Handlers\Events\Pusher;

use App\Events\MemberRemovedFromProjectEvent;

use App\Repositories\ProjectRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Pusher;

class MemberRemovedFromProject {

	private $pusher;
	private $projectRepository;

	/**
	 * Create the event handler.
	 * @param Pusher $pusher
	 * @param ProjectRepository $projectRepository
	 */
	public function __construct(Pusher $pusher, ProjectRepository $projectRepository)
	{
		$this->pusher = $pusher;
		$this->projectRepository = $projectRepository;
	}

	/**
	 * Handle the event.
	 *
	 * @param $event
	 */
	public function handle($event)
	{
		$project = $event->project;
		$users = $this->projectRepository->usersNotInProjectArray($project);
		$member = $event->subject;
		$channel = 'p' . $project->id;
		$membersEditPartial = view('users.partials.project-members-edit-body', compact('project', 'users'));
		$membersBodyPartial = view('users.partials.project-members-body', compact('project'));

		$this->pusher->trigger($channel, 'memberRemovedFromProject', [
			'membersEditPartial' => (String)$membersEditPartial,
			'membersBodyPartial' => (String)$membersBodyPartial,
			'memberId' => $member->id,
			'memberUsername' => $member->username
		]);

	}

}
