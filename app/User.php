<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * A User has one Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    /**
     * A User can start many Discussions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function discussions()
    {
        return $this->hasMany('App\Discussion');
    }

    /**
     * A user can leave many Comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * A User has many Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    /**
     * A User can be the admin of many Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function adminProjects()
    {
        return $this->belongsToMany('App\Project', 'project_adminUser');
    }

    /**
     * A User can have many tasks
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    /**
     * A User can have many notifications
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    /**
     * Register a new user
     *
     * @param $username
     * @param $email
     * @param $password
     * @return User
     */
    public static function register($username, $email, $password)
    {
        $user = new static([
            'username' => $username,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        return $user;
    }

    /**
     * Determine if the given user is the same
     * as the current one.
     *
     * @param  $user
     * @return bool
     */
    public function is($user)
    {
        if (is_null($user)) return false;

        return $this->username == $user->username;
    }

    /**
     * Determine if the current user is the admin of a given Project
     *
     * @param $projectId
     * @return mixed
     */
    public function isAdmin($projectId)
    {
        return $this->adminProjects->contains($projectId);
    }

    /**
     * Determine if the current user is a member of a given project
     *
     * @param $projectId
     * @return mixed
     */
    public function isMember($projectId)
    {
        return $this->projects->contains($projectId);
    }

    /**
     * Determine if the current user is a assigned to a given task
     *
     * @param $taskId
     * @return mixed
     */
    public function isAssignedToTask($taskId)
    {
        return $this->tasks->contains($taskId);
    }

    /**
     * Returns the tasks this user is assigned to in a given project
     *
     * @param $projectId
     * @return mixed
     */
    public function assignedTasks($projectId)
    {
        return $this->tasks->where('project_id', $projectId);
    }

    /**
     * Determine if the current user is the author of a given comment
     *
     * @param $commentId
     * @return mixed
     */
    public function isCommentAuthor($commentId)
    {
        return $this->comments->contains($commentId);
    }

    /**
     * Determine if the current user is the author of a given discussion
     *
     * @param $discussionId
     * @return mixed
     */
    public function isDiscussionAuthor($discussionId)
    {
        return $this->discussions->contains($discussionId);
    }


}
