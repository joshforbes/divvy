<?php namespace App\Http\Controllers;

use App\Activity;
use App\Commands\AddMemberToProjectCommand;
use App\Commands\ModifyProjectCommand;
use App\Commands\RemoveMemberFromProjectCommand;
use App\Commands\RemoveProjectCommand;
use App\Commands\StartNewProjectCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AddUserToProjectRequest;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Repositories\ProjectRepository;

class ProjectsController extends Controller {

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        parent::__construct();

        $this->projectRepository = $projectRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProjectRequest $request
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $project = $this->dispatch(
            new StartNewProjectCommand($request, $this->user)
        );

        return redirect()->route('project.show', $project->id);
    }

    /**
     * Add a user to the project. If the user doesn't exist,
     * send them an invite email.
     *
     * @param AddUserToProjectRequest $request
     * @param $projectId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addUser(AddUserToProjectRequest $request, $projectId)
    {
        $this->dispatch(
            new AddMemberToProjectCommand($request, $projectId, $this->user)
        );

        return redirect()->route('project.show', $projectId);
    }

    /**
     * Remove the specified user from the project
     *
     * @param $projectId
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeUser($projectId, $userId)
    {
        $this->dispatch(
            new RemoveMemberFromProjectCommand($projectId, $userId, $this->user)
        );

        return redirect()->route('project.show', $projectId);
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @return Response
     */
    public function show($projectId)
    {
        if ($this->user->isAdmin($projectId))
        {
            $project = $this->projectRepository->findByIdForAdmin($projectId);

            $users = $this->projectRepository->usersNotInProjectArray($project);

            return view('projects.admin', compact('project', 'users'));
        }

        $project = $this->projectRepository->findByIdForMember($projectId);

        $currentUserTasks = $this->projectRepository->tasksForUserInProject($this->user->id, $project);

        return view('projects.member', compact('project', 'currentUserTasks'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $projectId
     * @return Response
     */
    public function edit($projectId)
    {
        $project = $this->projectRepository->findById($projectId);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditProjectRequest $request
     * @param $projectId
     * @return Response
     */
    public function update(EditProjectRequest $request, $projectId)
    {
        $this->dispatch(
            new ModifyProjectCommand($request, $projectId, $this->user)
        );

        //Flash::message('Profile updated');
        return redirect()->route('project.show', [$projectId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->dispatch(
            new RemoveProjectCommand($id, $this->user)
        );

        return redirect()->route('home');
    }


}
