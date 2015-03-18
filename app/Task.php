<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    protected $fillable = ['name', 'description', 'project_id', 'user_id', 'is_complete'];

    public static function assign(array $attributes)
    {
        return new static($attributes);
    }

    /**
     * A Task belongs to one project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * A Task can be assigned to many Users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * A Task has many subtasks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subtasks()
    {
        return $this->hasMany('App\Subtask');
    }

    /**
     * A Task has many discussions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussions()
    {
        return $this->hasMany('App\Discussion')->orderBy('created_at', 'desc');
    }

    /**
     * Get a list of user ids associated with the current task
     *
     * @return array
     */
    public function getMemberListAttribute()
    {
        return $this->users->lists('id');
    }

    /**
     * If all subtasks are completed, returns true
     *
     * @return bool
     */
    public function isCompletable()
    {
        return $this->subtasks()->where('is_complete', 0)->count() === 0;
    }

    /**
     * Returns a boolean based on whether the task is completed
     *
     * @return mixed
     */
    public function isCompleted()
    {
        return $this->is_complete;
    }
}
