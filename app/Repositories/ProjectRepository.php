<?php namespace App\Repositories;

use App\Project;
use App\User;
use DB;

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
     * Removes a user from the specified project
     *
     * @param User $user
     * @param Project $project
     */
    public function removeUser(User $user, Project $project)
    {
        $project->users()->detach([$user->id]);
    }


    /**
     * Find a project by the specified id
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function findById($id)
    {
        return Project::find($id);
    }


    /**
     * Find a project by the specified id with eager loads needed
     * for admin view
     *
     * @param $id
     * @return mixed
     */
    public function findByIdForAdmin($id)
    {
        return Project::with('tasks.users.profile', 'users.profile', 'admins.profile', 'tasks.subtasks', 'tasks.discussions.author.profile', 'activity.subject', 'activity.user')->whereId($id)->firstOrFail();
    }

    /**
     * Find a project by id - with less eager loading for Member view
     *
     * @param $id
     */
    public function findByIdForMember($id)
    {
        return Project::with('users.profile')->whereId($id)->firstOrFail();
    }


    /**
     * Returns an array of users that are not members of the  project
     *
     * @param $project
     * @return mixed
     */
    public function usersNotInProjectArray($project)
    {
        $ids = DB::table('project_user')->where('project_id', '=', $project->id)->lists('user_id');

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

    /**
     * Find tasks for the specified user in the specified project
     *
     * @param $userId
     * @param Project $project
     * @return mixed
     */
    public function tasksForUserInProject($userId, Project $project)
    {
        return $project->tasks()->with('subtasks', 'discussions.author.profile', 'users.profile')
            ->whereHas('users', function($q) use($userId){
                $q->where('user_id', $userId);
            })->get();
    }


}