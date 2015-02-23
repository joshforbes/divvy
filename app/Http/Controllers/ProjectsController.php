<?php namespace App\Http\Controllers;

use App\Commands\AddMemberToProjectCommand;
use App\Commands\StartNewProjectCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AddUserToProjectRequest;
use App\Http\Requests\CreateProjectRequest;
use App\Repositories\ProjectRepository;
use Auth;

class ProjectsController extends Controller {

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
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
            new StartNewProjectCommand($request, Auth::user())
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
        $project = $this->projectRepository->findById($projectId);

        if (Auth::user()->isAdmin($projectId))
        {
            $users = $this->projectRepository->usersNotInProjectArray($project);

            return view('projects.admin', compact('project', 'users'));
        }

        return view('projects.member', compact('project'));

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
