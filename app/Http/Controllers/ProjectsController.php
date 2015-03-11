<?php namespace App\Http\Controllers;

use App\Commands\AddMemberToProjectCommand;
use App\Commands\StartNewProjectCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AddUserToProjectRequest;
use App\Http\Requests\CreateProjectRequest;
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
        $project = $this->dispatch(
            new AddMemberToProjectCommand($request, $projectId)
        );

        return redirect()->route('project.show', $project->id);
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
            $project = $this->projectRepository->findById($projectId);

            $users = $this->projectRepository->usersNotInProjectArray($project);

            $members = $this->projectRepository->usersInProjectArray($project);

            return view('projects.admin', compact('project', 'users', 'members'));
        }

        $project = $this->projectRepository->findByIdForMember($projectId);

        $currentUserTasks = $this->projectRepository->tasksForUserInProject($this->user->id, $project);

        return view('projects.member', compact('project', 'currentUserTasks'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
