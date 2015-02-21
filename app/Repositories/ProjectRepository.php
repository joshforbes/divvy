<?php namespace App\Repositories;

use App\Project;
use App\User;

class ProjectRepository {


    /**
     * Persist a project
     *
     * @param Project $project
     */
    public function save(Project $project)
    {
        $project->save();
    }

    public function addAdmin(User $user, Project $project)
    {
        $project->adminUsers()->sync([$user->id], false);
    }

    public function addUser(User $user, Project $project)
    {
        $project->users()->sync([$user->id], false);
    }

    public function findById($id)
    {
        return Project::with('adminUsers', 'users')->whereId($id)->firstOrFail();
    }

    /**
     * Returns an array of users that are not members of the  project
     *
     * @param $project
     * @return mixed
     */
    public function usersNotInProjectArray($project)
    {
        $ids = \DB::table('project_user')->where('project_id', '=', $project->id)->lists('user_id');

        return User::whereNotIn('id', $ids)->lists('username', 'email');

    }


}