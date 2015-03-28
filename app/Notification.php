<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $fillable = ['action', 'read', 'subject_type', 'subject_id', 'user_id', 'actor_id', 'project_id'];

    /**
     * An Notification belongs to one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * An Notification belongs to one actor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actor()
    {
        return $this->belongsTo('App\User', 'actor_id');
    }

    /**
     * An Notification is associated with one project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id')->withTrashed();
    }

    /**
     * Get the subject of the activity.
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo()->withTrashed();
    }


    /**
     * Create a new instance of Notification
     *
     * @param array $attributes
     * @return static
     */
    public static function notify(array $attributes)
    {
        return new static($attributes);
    }

}
