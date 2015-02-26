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

    /**
     * Adds an admin to the specified project
     *
     * @param User $user
     * @param Project $project
     */
    public function addAdmin(User $user, Project $project)
    {
        $project->admins()->sync([$user->id], false);
    }

    /**
     * Adds a user to the specified project
     *
     * @param User $user
     * @param Project $project
     */
    public function addUser(User $user, Project $project)
    {
        $project->users()->sync([$user->id], false);
    }


    /**
     * Find a project by the specified id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Project::with('admins', 'users')->whereId($id)->firstOrFail();
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

    /**
     * Returns an array of users that are members of the project
     *
     * @param $project
     * @return mixed
     */
    public function usersInProjectArray($project)
    {
        return $project->users()->lists('username', 'user_id');
    }


}