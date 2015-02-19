<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\AddUserToProjectRequest;
use App\Http\Requests\CreateProjectRequest;
use App\Project;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProjectRequest $request
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();

        $user = \Auth::user();
        $project = Project::create($input);

        $project->adminUsers()->attach($user);
        $project->users()->attach($user);

        return redirect()->route('project.show', $project->id);
    }

    /**
     * Add a user to the project. If the user doesn't exist,
     * send them an invite email.
     *
     * @param AddUserToProjectRequest $request
     * @param $projectId
     * @param UserRepository $userRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addUser(AddUserToProjectRequest $request, $projectId, UserRepository $userRepository)
    {
        $project = Project::find($projectId);

        $user = $userRepository->findByEmail($request->input('user'));

        if (!$user)
        {
            dd('invite email');
        }

        $project->users()->attach($user->id);

        return redirect()->route('project.show', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $project = Project::with('adminUsers', 'users')->whereId($id)->firstOrFail();
        $users = User::lists('username', 'email');

        return view('projects.show', compact('project', 'users'));
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
