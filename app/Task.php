<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    protected $fillable = ['name', 'description', 'project_id', 'user_id'];

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
     * Get a list of user ids associated with the current task
     *
     * @return array
     */
    public function getMemberListAttribute()
    {
        return $this->users->lists('id');
    }
}
